<?php

namespace App\Http\Controllers;

use App\Models\CulturalRule;
use App\Models\Location;
use App\Services\GeminiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SantiChatController extends Controller
{
    public function __construct(
        protected GeminiService $geminiService
    ) {}

    /**
     * Display the Santi Landing Page with Bali cultural identity.
     */
    public function index(): View
    {
        $locations = Location::active()
            ->withCount(['culturalRules as verified_rules_count' => function ($query) {
                $query->where('is_verified', true)->where('is_active', true);
            }])
            ->get();

        return view('landing', compact('locations'));
    }

    /**
     * Display dedicated location selection page (for direct QR scan and discovery).
     */
    public function locations(): View
    {
        $locations = Location::active()
            ->with(['verifiedCulturalRules'])
            ->get();

        return view('locations', compact('locations'));
    }

    /**
     * Display the Cultural Guidelines & Regulations page for a specific location.
     */
    public function guidelines(Location $location): View
    {
        if (! $location->is_active) {
            abort(404, 'Lokasi budaya ini sedang tidak aktif.');
        }

        $location->load(['culturalRules' => function ($query) {
            $query->where('is_active', true);
        }]);

        $allLocations = Location::active()
            ->where('id', '!=', $location->id)
            ->withCount(['culturalRules as verified_rules_count' => function ($query) {
                $query->where('is_verified', true)->where('is_active', true);
            }])
            ->get();

        $templeImages = [
            'pura-besakih' => 'images/hero-candi-bentar.jpg',
            'pura-ulun-danu-beratan' => 'images/hero-bali.jpg',
            'pura-uluwatu' => 'images/service-location.jpg',
            'pura-tirta-empul' => 'images/service-guidelines.jpg',
            'pura-tanah-lot' => 'images/hero-candi-bentar.jpg',
            'desa-penglipuran' => 'images/about-bali-guide.jpg',
            'jatiluwih-rice-terraces' => 'images/service-location.jpg',
            'pantai-kuta' => 'images/hero-bali.jpg',
            'gwk-cultural-park' => 'images/hero-light.jpg',
            'ubud-monkey-forest' => 'images/about-bali-guide.jpg',
            'gunung-batur-kintamani' => 'images/service-location.jpg',
            'pura-desa-simulasi' => 'images/about-bali-guide.jpg',
        ];

        $locationImage = $templeImages[$location->slug] ?? 'images/hero-candi-bentar.jpg';

        $rulesByCategory = [
            'dress_code' => $location->culturalRules->where('category', 'dress_code'),
            'sacred_area' => $location->culturalRules->where('category', 'sacred_area'),
            'behavior' => $location->culturalRules->where('category', 'behavior'),
            'photography' => $location->culturalRules->where('category', 'photography'),
            'general' => $location->culturalRules->where('category', 'general'),
        ];

        return view('guidelines', compact('location', 'allLocations', 'locationImage', 'rulesByCategory'));
    }

    /**
     * Display the AI Cultural Assistant in general mode covering all Bali destinations.
     */
    public function general(): View
    {
        $location = Location::where('slug', 'seluruh-bali')->first();

        if (! $location) {
            $location = Location::where('is_active', true)->firstOrFail();
        }

        return $this->show($location);
    }

    /**
     * Display the AI Cultural Assistant for a specific location.
     */
    public function show(Location $location): View
    {
        if (! $location->is_active) {
            abort(404, 'Lokasi budaya ini sedang tidak aktif.');
        }

        $location->load('verifiedCulturalRules');
        $allLocations = Location::active()->orderBy('id')->get();

        $suggestedQuestions = $this->buildSuggestedQuestions($location);

        $templeImages = [
            'seluruh-bali' => 'images/hero-candi-bentar.jpg',
            'pura-besakih' => 'images/hero-candi-bentar.jpg',
            'pura-ulun-danu-beratan' => 'images/hero-bali.jpg',
            'pura-uluwatu' => 'images/service-location.jpg',
            'pura-tirta-empul' => 'images/service-guidelines.jpg',
            'pura-tanah-lot' => 'images/hero-candi-bentar.jpg',
            'desa-penglipuran' => 'images/about-bali-guide.jpg',
            'jatiluwih-rice-terraces' => 'images/service-location.jpg',
            'pantai-kuta' => 'images/hero-bali.jpg',
            'gwk-cultural-park' => 'images/hero-light.jpg',
            'ubud-monkey-forest' => 'images/about-bali-guide.jpg',
            'gunung-batur-kintamani' => 'images/service-location.jpg',
            'pura-desa-simulasi' => 'images/about-bali-guide.jpg',
        ];

        $locationImage = $templeImages[$location->slug] ?? 'images/hero-candi-bentar.jpg';

        return view('chat', compact('location', 'allLocations', 'suggestedQuestions', 'locationImage'));
    }

    /**
     * Handle incoming chat requests to Santi AI.
     */
    public function chat(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:1000'],
            'location_slug' => ['required', 'string', 'exists:locations,slug'],
            'language' => ['nullable', 'in:id,en,zh,ja,ru,fr,de'],
            'history' => ['nullable', 'array', 'max:10'],
            'history.*.role' => ['required_with:history', 'in:user,assistant,model'],
            'history.*.content' => ['required_with:history', 'string', 'max:1500'],
        ], [
            'message.required' => 'Pertanyaan tidak boleh kosong.',
            'message.max' => 'Pertanyaan maksimal 1000 karakter.',
            'location_slug.exists' => 'Lokasi yang dipilih tidak ditemukan.',
        ]);

        $location = Location::where('slug', $validated['location_slug'])
            ->where('is_active', true)
            ->first();

        if (! $location) {
            return response()->json([
                'status' => 'error',
                'answer' => 'Lokasi yang dipilih sedang tidak aktif atau tidak ditemukan.',
                'location' => null,
                'sources' => [],
            ], 404);
        }

        if ($location->slug === 'seluruh-bali') {
            $verifiedRules = CulturalRule::where('is_verified', true)
                ->where('is_active', true)
                ->get();
        } else {
            $verifiedRules = $location->verifiedCulturalRules()->get();
        }

        $language = $validated['language'] ?? 'id';
        $history = $validated['history'] ?? [];

        $response = $this->geminiService->generateCulturalGuidance(
            $location,
            $verifiedRules,
            $validated['message'],
            $history,
            $language
        );

        return response()->json($response);
    }

    /**
     * Build contextual suggested questions for a destination (beaches, cultural villages, mountains, temples, etc.).
     */
    protected function buildSuggestedQuestions(Location $location): array
    {
        $slug = $location->slug;

        if ($slug === 'seluruh-bali') {
            return [
                'id' => [
                    'Apa aturan pakaian di pantai vs saat berjalan di jalan umum & toko di Bali?',
                    'Bagaimana etika dan ketentuan busana jika ingin berkunjung ke pura di Bali?',
                    'Apa saja larangan penting bagi wisatawan menurut SE Gubernur Bali No. 4/2023?',
                    'Bagaimana etika saat berpapasan dengan upacara adat atau canang sari di jalan?',
                    'Bolehkah menerbangkan drone di tempat wisata atau pementasan tari di Bali?',
                    'Bagaimana tata krama saat berkunjung ke desa adat dan mendaki gunung sakral?',
                ],
                'en' => [
                    'What are the dress code rules for beaches vs public streets and temples in Bali?',
                    'What is the proper etiquette and required attire when visiting Balinese temples?',
                    'What conduct is strictly prohibited for tourists under Bali Governor Circular No. 4/2023?',
                    'What should I do when encountering a religious procession or canang sari offerings?',
                    'Are drones permitted at tourist attractions and traditional dance performances?',
                    'What is the proper etiquette when visiting cultural villages and sacred mountains?',
                ],
                'zh' => [
                    '在巴厘岛，沙滩与公共街道、商店以及寺庙的着装规范有什么区别？',
                    '参观巴厘岛传统印度教寺庙有哪些着装要求与礼仪禁忌？',
                    '根据巴厘省长第4/2023号令，游客有哪些绝对禁止的行为？',
                    '遇到宗教游行队伍或地面上的供品（Canang Sari）应如何礼貌应对？',
                    '在巴厘岛旅游景点或传统舞蹈表演区域可以使用无人机吗？',
                    '造访传统文化村落或攀登圣山有哪些必须遵守的规矩？',
                ],
                'ja' => [
                    'バリ島におけるビーチと一般道路・店舗・寺院での服装マナーの違いは何ですか？',
                    '寺院（プライン）を訪問する際の正しい服装規定と参拝マナーを教えてください。',
                    'バリ州知事令2023年第4号で観光客に固く禁止されている行為は何ですか？',
                    '道路での宗教行列や地面の供物（チャナン）に出会った時の注意点は何ですか？',
                    '観光地や伝統舞踊の公演会場でドローンを飛ばすことはできますか？',
                    '伝統的な村落や聖なる山を訪れる際の礼儀作法はどうなっていますか？',
                ],
                'ru' => [
                    'Каковы правила дресс-кода для пляжей, улиц и храмов на Бали?',
                    'Какой этикет и форма одежды обязательны при посещении храмов на Бали?',
                    'Какое поведение строго запрещено туристам циркуляром губернатора Бали № 4/2023?',
                    'Что делать при встрече с религиозной процессией или подношениями чананг сари?',
                    'Разрешено ли использовать дроны в туристических местах и на танцевальных представлениях?',
                    'Каковы правила вежливости при посещении традиционных деревень и восхождении на горы?',
                ],
                'fr' => [
                    'Quels sont les codes vestimentaires entre plages, rues commerçantes et temples à Bali ?',
                    'Quelle est la tenue appropriée et les règles de politesse pour visiter les temples ?',
                    'Quelles sont les interdictions majeures pour les touristes selon la circulaire SE n° 4/2023 ?',
                    'Comment réagir face à une procession religieuse ou des offrandes canang sari au sol ?',
                    'L\'utilisation de drones est-elle autorisée sur les sites touristiques et spectacles de danse ?',
                    'Quelles sont les règles de respect dans les villages coutumiers et montagnes sacrées ?',
                ],
                'de' => [
                    'Welche Kleiderordnung gilt für Strände im Vergleich zu Straßen und Tempeln auf Bali?',
                    'Welche Verhaltensregeln und Kleidung sind beim Besuch von Tempeln Pflicht?',
                    'Welche Verbote gelten für Touristen laut dem Erlass des Gouverneurs von Bali Nr. 4/2023?',
                    'Wie verhalte ich mich bei religiösen Prozessionen oder Opfergaben (Canang Sari) am Boden?',
                    'Dürfen Drohnen an Sehenswürdigkeiten und bei Tanzaufführungen geflogen werden?',
                    'Welche Höflichkeitsregeln gelten beim Besuch traditioneller Dörfer und heiliger Berge?',
                ],
            ];
        }
        $slug = $location->slug;

        if ($slug === 'pantai-kuta') {
            return [
                'id' => [
                    'Bolehkah saya mengenakan bikini atau pakaian renang saat keluar ke jalan sekitar pantai?',
                    'Apa yang harus saya lakukan jika melihat sesajen (canang sari) di pasir pantai?',
                    'Bagaimana aturan keselamatan laut dan arti bendera Balawista di Pantai Kuta?',
                    'Apa saja larangan bagi wisatawan di kawasan pesisir menurut SE Gubernur Bali?',
                    'Apakah diperbolehkan membawa minuman keras atau membuang sampah sembarangan di pantai?',
                ],
                'en' => [
                    'Can I wear swimwear or a bikini when walking on the streets outside the beach?',
                    'What should I do if I see canang sari offerings on the beach sand?',
                    'What are the ocean safety guidelines and Balawista flag rules at Kuta Beach?',
                    'What conduct is strictly prohibited for tourists in coastal areas under Bali regulations?',
                    'Are alcohol and waste disposal restricted on Bali public beaches?',
                ],
                'zh' => [
                    '离开沙滩前往附近街道或商店时可以穿比基尼或泳装吗？',
                    '如果在沙滩上看到印度教供品（Canang Sari）应该注意什么？',
                    '库塔海滩的海上安全标志和救生旗有什么含义？',
                    '根据巴厘省长令，游客在海岸区域严禁进行哪些行为？',
                    '在公共海滩饮酒或丢弃垃圾有哪些处罚与规定？',
                ],
                'ja' => [
                    'ビーチから周辺の道路や店舗に出る際、水着やビキニのままでもいいですか？',
                    '砂浜に置かれたお供え物（チャナン・サリ）を見かけた際の注意点は何ですか？',
                    'クタビーチにおける遊泳安全旗やライフガードの規則を教えてください。',
                    'バリ州知事令に基づき、海岸エリアで観光客が固く禁止されている行為は何ですか？',
                    'ビーチでの飲酒やゴミのポイ捨てに関する規則はどうなっていますか？',
                ],
                'ru' => [
                    'Можно ли ходить в купальнике или плавках по улицам за пределами пляжа?',
                    'Что делать, если я вижу ритуальные подношения (чананг сари) на песке?',
                    'Каковы правила безопасности на воде и значения флагов спасателей в Куте?',
                    'Какое поведение строго запрещено туристам на побережье по законам Бали?',
                    'Разрешен ли алкоголь и как утилизировать мусор на пляже?',
                ],
                'fr' => [
                    'Puis-je porter un maillot de bain ou bikini en marchant dans les rues en dehors de la plage ?',
                    'Que faire si je vois des offrandes (canang sari) sur le sable de la plage ?',
                    'Quelles sont les règles de sécurité en mer et la signification des drapeaux à Kuta ?',
                    'Quelles sont les interdictions strictes pour les touristes sur le littoral balinais ?',
                    'Quelles sont les règles concernant les déchets et l\'alcool sur les plages ?',
                ],
                'de' => [
                    'Darf ich im Badeanzug oder Bikini auf den Straßen außerhalb des Strandes herumlaufen?',
                    'Wie verhalte ich mich bei Opfergaben (Canang Sari) im Strandsand?',
                    'Welche Sicherheitsregeln und Flaggenbedeutungen gelten am Strand von Kuta?',
                    'Welche Verhaltensweisen sind an balinesischen Stränden streng verboten?',
                    'Welche Vorschriften gelten bezüglich Müll und Alkohol am Strand?',
                ],
            ];
        }

        if ($slug === 'desa-penglipuran') {
            return [
                'id' => [
                    'Bagaimana etika saat saya ingin masuk dan memotret ke dalam pekarangan rumah warga?',
                    'Mengapa kendaraan bermotor dan rokok dilarang di jalur pemukiman desa ini?',
                    'Apakah wisatawan boleh memasuki area sanggah (pelinggih suci keluarga warga)?',
                    'Apa busana yang pantas saat menjelajahi desa adat dan hutan bambu Penglipuran?',
                    'Apa tradisi adat unik warga Penglipuran yang wajib dihormati pengunjung?',
                ],
                'en' => [
                    'What is the courtesy when entering and photographing inside local family compounds?',
                    'Why are motorized vehicles and smoking prohibited in the village main path?',
                    'Are tourists allowed to enter the sacred family shrines (sanggah) inside homes?',
                    'What is the respectful dress code for exploring Penglipuran and the bamboo forest?',
                    'What unique customary traditions of Penglipuran should visitors respect?',
                ],
                'zh' => [
                    '进入村民传统庭院参观拍照时有哪些礼貌规矩？',
                    '为什么该村主街严禁机动车通行与吸烟？',
                    '游客可以进入民宅内部的家族神龛（Sanggah）区域吗？',
                    '漫步彭利普兰村与竹林时应穿着怎样的得体服装？',
                    '游客应当尊重彭利普兰村民哪些独特的传统习俗？',
                ],
                'ja' => [
                    '地元住民の敷地内に入って見学や撮影をする際のマナーは何ですか？',
                    'なぜこの村のメインストリートでは車両の進入や喫煙が禁止されているのですか？',
                    '民家の敷地内にある家族の祠（サンガ）に入ってもいいですか？',
                    '村や竹林を散策する際の適切な服装規定を教えてください。',
                    '観光客が尊重すべき彭利普兰村特有の伝統習慣は何ですか？',
                ],
                'ru' => [
                    'Каков этикет при входе и фотосъемке во дворах местных жителей?',
                    'Почему на центральной улице деревни запрещен транспорт и курение?',
                    'Разрешено ли туристам заходить в семейные святилища (сангах) в домах?',
                    'Как следует одеваться для прогулки по деревне и бамбуковому лесу?',
                    'Какие уникальные традиции деревни Пенглипуран важно уважать?',
                ],
                'fr' => [
                    'Quelle est l\'étiquette pour visiter et photographier l\'intérieur des cours familiales ?',
                    'Pourquoi les véhicules à moteur et le tabac sont-ils interdits dans le village ?',
                    'Les touristes peuvent-ils entrer dans les sanctuaires familiaux (sanggah) des maisons ?',
                    'Quelle tenue est appropriée pour visiter le village et la forêt de bambous ?',
                    'Quelles coutumes spécifiques de Penglipuran doivent être respectées ?',
                ],
                'de' => [
                    'Welche Höflichkeitsregeln gelten beim Betreten traditioneller Wohnhöfe?',
                    'Warum sind Motorfahrzeuge und Rauchen im Dorfzentrum verboten?',
                    'Dürfen Touristen die familieneigenen Hausschreine (Sanggah) betreten?',
                    'Welche Kleidung ist für den Besuch des Dorfes und des Bambuswaldes angemessen?',
                    'Welche besonderen Bräuche von Penglipuran sollten Besucher respektieren?',
                ],
            ];
        }

        if ($slug === 'jatiluwih-rice-terraces') {
            return [
                'id' => [
                    'Apakah ada aturan khusus saat melintasi pematang sawah dan jalur trekking di sini?',
                    'Mengapa pelinggih Pura Bedugul di petak sawah disucikan dan tidak boleh dipanjat?',
                    'Bagaimana kebijakan bebas sampah plastik yang diterapkan di kawasan UNESCO Jatiluwih?',
                    'Apakah penggunaan drone diperbolehkan di atas terasering sawah Jatiluwih?',
                    'Apa makna filosofi Tri Hita Karana dalam sistem irigasi Subak Bali?',
                ],
                'en' => [
                    'Are there specific guidelines when trekking across the rice terraces here?',
                    'Why are Pura Bedugul shrines in the paddies sacred and forbidden to climb?',
                    'What is the zero-plastic waste policy implemented at UNESCO Jatiluwih?',
                    'Is drone flying allowed over the rice terraces of Jatiluwih?',
                    'What is the meaning of Tri Hita Karana in the Balinese Subak irrigation system?',
                ],
                'zh' => [
                    '在梯田徒步路线上漫步时有哪些注意事项？',
                    '为什么稻田中的水神庙（Pura Bedugul）神圣不可攀爬？',
                    '联合国教科文组织嘉梯路维保护区如何实行无塑料垃圾政策？',
                    '在梯田上空飞行动火机/无人机（Drone）需要何种许可？',
                    '巴厘苏巴克（Subak）灌溉系统中三界和谐（Tri Hita Karana）的意义是什么？',
                ],
                'ja' => [
                    '棚田のトレッキングコースを歩く際の具体的な注意事項は何ですか？',
                    '田んぼの中にあるプラ・ブドゥグル（水の神の祠）が神聖視され登ってはいけない理由は何ですか？',
                    'ユネスコ遺産ジャティルイで実施されているプラスチックゴミ禁止方針とは何ですか？',
                    'ジャティルイの棚田上空でドローンを飛行させることは許可されていますか？',
                    'スバック灌漑システムにおける「トリ・ヒタ・カラナ」の哲学の意味を教えてください。',
                ],
                'ru' => [
                    'Каковы правила прогулок по рисовым террасам и треккинговым тропам?',
                    'Почему алтари Пура Бедугул на полях священны и на них нельзя взбираться?',
                    'Какова политика отказа от пластика в охраняемой зоне ЮНЕСКО Джатилувих?',
                    'Разрешены ли полеты дронов над рисовыми террасами Джатилувих?',
                    'В чем смысл философии Три Хита Карана в ирригационной системе Субак?',
                ],
                'fr' => [
                    'Quelles sont les règles lors des randonnées le long des rizières en terrasses ?',
                    'Pourquoi les petits sanctuaires Pura Bedugul dans les champs sont-ils sacrés ?',
                    'Quelle est la politique zéro plastique appliquée sur le site UNESCO de Jatiluwih ?',
                    'L\'utilisation de drones est-elle autorisée au-dessus des rizières de Jatiluwih ?',
                    'Quelle est la signification de Tri Hita Karana dans le système d\'irrigation Subak ?',
                ],
                'de' => [
                    'Welche Verhaltensregeln gelten auf den Wanderpfaden durch die Reisterrassen?',
                    'Warum sind die Pura Bedugul Schreine in den Feldern heilig und dürfen nicht bestiegen werden?',
                    'Welche plastikfreie Richtlinie gilt im UNESCO-Gebiet Jatiluwih?',
                    'Ist das Fliegen von Drohnen über den Reisterrassen von Jatiluwih erlaubt?',
                    'Welche Bedeutung hat Tri Hita Karana im balinesischen Subak-Bewässerungssystem?',
                ],
            ];
        }

        if ($slug === 'gwk-cultural-park') {
            return [
                'id' => [
                    'Bagaimana etika saat menyaksikan pementasan Tari Kecak & Barong di amfiteater GWK?',
                    'Bolehkah menyalakan flash kamera ke arah mata penari saat pertunjukan seni berlangsung?',
                    'Apa makna spiritual dan kultural dari patung Dewa Wisnu dan Burung Garuda?',
                    'Apakah diperbolehkan menerbangkan drone di sekitar monumen patung GWK?',
                    'Apa saja fasilitas budaya dan pameran seni yang dapat dieksplorasi di sini?',
                ],
                'en' => [
                    'What is the proper etiquette when watching Kecak & Barong dance performances at GWK?',
                    'Can I use camera flash toward dancers\' eyes during live cultural performances?',
                    'What is the spiritual and cultural symbolism of Lord Vishnu and the mythical Garuda?',
                    'Is drone flying allowed around the monumental GWK statue?',
                    'What cultural exhibitions and heritage galleries can be explored here?',
                ],
                'zh' => [
                    '在 GWK 露天剧场观赏凯卡克舞（Kecak）与巴龙舞时有哪些观赏礼仪？',
                    '演出期间可以使用相机闪光灯直接对准舞者眼睛拍照吗？',
                    '毗湿奴神与神鸟迦楼罗（Garuda）巨像具有怎样的精神文化寓意？',
                    '在 GWK 纪念雕像周边是否允许操作无人机航拍？',
                    '园区内有哪些值得深度探索的巴厘文化展馆与艺术画廊？',
                ],
                'ja' => [
                    'GWKの円形劇場でケチャダンスやバロンダンスを鑑賞する際のマナーは何ですか？',
                    '公演中にカメラのフラッシュをダンサーの目に向けて撮影してもいいですか？',
                    'ヴィシュヌ神と神鳥ガルーダの巨大像にはどのような精神的・文化的意味がありますか？',
                    'GWKモニュメント周辺でのドローン飛行は許可されていますか？',
                    '施設内で体験できるバリ文化展示やアートギャラリーにはどのようなものがありますか？',
                ],
                'ru' => [
                    'Каков этикет при просмотре танцев Кечак и Баронг в амфитеатре GWK?',
                    'Можно ли использовать вспышку камеры в сторону танцоров во время выступления?',
                    'Каково духовное значение монумента бога Вишну и мифической птицы Гаруда?',
                    'Разрешено ли запускать дроны вокруг огромной статуи GWK?',
                    'Какие культурные выставки и галереи можно посетить в этом парке?',
                ],
                'fr' => [
                    'Quelle est l\'attitude respectueuse pour assister aux danses Kecak et Barong à GWK ?',
                    'Peut-on utiliser le flash vers les yeux des danseurs pendant le spectacle ?',
                    'Quelle est la symbolique culturelle et spirituelle de la statue de Vishnu et Garuda ?',
                    'Le vol de drone est-il autorisé autour de la statue monumentale de GWK ?',
                    'Quelles galeries d\'art et expositions culturelles peut-on découvrir sur place ?',
                ],
                'de' => [
                    'Welche Verhaltensregeln gelten beim Besuch der Kecak- und Barong-Aufführungen im GWK?',
                    'Darf während der Tanzvorführungen mit Kamerablitz fotografiert werden?',
                    'Welche spirituelle Symbolik haben die Monumentalstatuen von Gott Vishnu und Garuda?',
                    'Ist das Fliegen von Drohnen um die GWK-Statue gestattet?',
                    'Welche Kulturausstellungen und Kunstgalerien können hier erkundet werden?',
                ],
            ];
        }

        if ($slug === 'ubud-monkey-forest') {
            return [
                'id' => [
                    'Bagaimana etika aman saat berinteraksi dengan kera ekor panjang di Wenara Wana?',
                    'Mengapa wisatawan dilarang keras membawa atau memberi makanan dari luar ke kera?',
                    'Apakah wisatawan boleh memasuki area suci Pura Dalem Agung di dalam hutan?',
                    'Apa yang harus saya lakukan jika kera melompat ke pundak atau mengambil barang berharga?',
                    'Apa makna kesucian hutan dan pohon beringin keramat bagi masyarakat adat Ubud?',
                ],
                'en' => [
                    'What is the safety etiquette when interacting with long-tailed macaques in Wenara Wana?',
                    'Why are visitors strictly prohibited from bringing or feeding outside snacks to the monkeys?',
                    'Are tourists allowed to enter the sacred Pura Dalem Agung temple inside the forest?',
                    'What should I do if a monkey jumps onto my shoulder or grabs a personal item?',
                    'What is the sacred meaning of the forest and ancient banyan trees to Ubud locals?',
                ],
                'zh' => [
                    '在圣猴森林公园与长尾猕猴安全互动有哪些关键注意事项？',
                    '为什么严禁游客携带外界自带食物或零食投喂猴子？',
                    '游客可以进入森林内部的神圣大公庙（Pura Dalem Agung）吗？',
                    '如果猴子跳上肩膀或抢夺随身贵重物品，应该如何冷静处理？',
                    '乌布传统社区如何看待该森林与古老榕树的神圣信仰？',
                ],
                'ja' => [
                    'ウブドのモンキーフォレストでサルと安全に触れ合うためのマナーは何ですか？',
                    '外部から持ち込んだスナックや食べ物をサルに与えることが固く禁止されている理由は何ですか？',
                    '森林内にある聖なるプラ・ダレム寺院の内部に入ることは許可されていますか？',
                    'サルが肩に乗ってきたり、所持品を取られそうになった場合はどう対処すべきですか？',
                    'ウブドの人々にとって、この森林や古代のガジュマルの木が神聖とされる意味は何ですか？',
                ],
                'ru' => [
                    'Каковы правила безопасного взаимодействия с макаками в Лесу обезьян Убуда?',
                    'Почему туристам строго запрещено кормить обезьян принесенной с собой едой?',
                    'Можно ли туристам входить в священный храм Пура Далем Агунг внутри леса?',
                    'Что делать, если обезьяна запрыгнула на плечо или схватила ценную вещь?',
                    'В чем духовное значение священного леса и древних баньянов для жителей Убуда?',
                ],
                'fr' => [
                    'Quelles sont les règles de sécurité pour interagir avec les singes de la forêt sacrée ?',
                    'Pourquoi est-il strictement interdit de nourrir les singes avec de la nourriture extérieure ?',
                    'Les touristes peuvent-ils entrer dans le temple sacré Pura Dalem à l\'intérieur de la forêt ?',
                    'Que faire si un singe saute sur une épaule ou s\'empare d\'un objet personnel ?',
                    'Quelle est la signification sacrée de cette forêt et de ses banians centenaires ?',
                ],
                'de' => [
                    'Welche Sicherheitsregeln gelten beim Umgang mit den Affen im Monkey Forest Ubud?',
                    'Warum ist das Füttern mit mitgebrachten Lebensmitteln strengstens verboten?',
                    'Dürfen Besucher den heiligen Pura Dalem Tempel im Inneren des Waldes betreten?',
                    'Wie verhalte ich mich, wenn ein Affe auf die Schulter springt oder Gegenstände greift?',
                    'Welche spirituelle Bedeutung haben der heilige Wald und die Banyanbäume für Ubud?',
                ],
            ];
        }

        if ($slug === 'gunung-batur-kintamani') {
            return [
                'id' => [
                    'Mengapa pendakian Gunung Batur wajib didampingi pemandu lokal resmi (HPPGB)?',
                    'Apa saja larangan sakral saat berada di puncak gunung menurut SE Gubernur Bali No. 4/2023?',
                    'Bolehkah berfoto dengan pose tidak senonoh atau membuka pakaian di puncak gunung?',
                    'Bagaimana aturan pengelolaan sampah dan etika menjaga kelestarian kaldera Batur?',
                    'Apa makna kesucian gunung (hulu spiritual) bagi masyarakat Hindu Dharma di Bali?',
                ],
                'en' => [
                    'Why is hiking Mount Batur mandatory with a certified local guide (HPPGB)?',
                    'What sacred restrictions apply at the mountain summit under Bali Governor Circular No. 4/2023?',
                    'Is disrobing or posing inappropriately for photos strictly forbidden on sacred peaks?',
                    'What are the zero-waste policies and eco-trekking ethics on Mount Batur caldera?',
                    'What is the spiritual significance of sacred mountains as the holy upstream in Bali?',
                ],
                'zh' => [
                    '为什么攀登巴图尔火山必须由持证当地向导（HPPGB）陪同？',
                    '根据巴厘省长第4号通告，在神山山顶有哪些神圣禁忌与法规？',
                    '在山顶拍摄不雅姿势或暴露裸露照片为何会被严厉惩处并驱逐？',
                    '攀登巴图尔火山口时应遵循怎样的零垃圾环保登山守则？',
                    '对于巴厘印度教徒而言，神山作为精神源头的神圣象征意义是什么？',
                ],
                'ja' => [
                    'バトゥール山登山に公認ローカルガイド（HPPGB）の同行が義務付けられている理由は何ですか？',
                    'バリ州知事令第4号に基づき、神聖な山頂で厳格に禁止されている行為は何ですか？',
                    '山頂で衣服を脱いだり、不適切なポーズで写真撮影をすることはなぜ固く禁じられているのですか？',
                    'バトゥール山のカルデラ保護のためのゴミ管理規則とエコツーリズムマナーを教えてください。',
                    'バリの人々にとって「聖なる山」が精神的な源流とされる意味は何ですか？',
                ],
                'ru' => [
                    'Почему восхождение на вулкан Батур обязательно с местным сертифицированным гидом?',
                    'Какие священные запреты действуют на вершине по указу губернатора Бали № 4/2023?',
                    'Почему категорически запрещено обнажаться или делать неподобающие фото на вершине?',
                    'Каковы правила утилизации отходов и эко-этикета на кальдере вулкана Батур?',
                    'Каково духовное значение священных гор как истока жизни для жителей Бали?',
                ],
                'fr' => [
                    'Pourquoi l\'ascension du Mont Batur nécessite-t-elle obligatoirement un guide local agréé ?',
                    'Quelles sont les interdictions sacrées au sommet selon la circulaire gouvernorale n° 4/2023 ?',
                    'Pourquoi est-il strictement interdit de se dévêtir ou de poser de manière indécente au sommet ?',
                    'Quelles sont les règles de gestion des déchets pour préserver la caldeira de Batur ?',
                    'Quelle est la signification sacrée des montagnes dans la spiritualité balinaise ?',
                ],
                'de' => [
                    'Warum ist die Besteigung des Mount Batur nur mit einem lizenzierten Bergführer gestattet?',
                    'Welche heiligen Verbote gelten auf dem Vulkangipfel gemäß Erlass Nr. 4/2023?',
                    'Warum sind Nacktheit oder anstößige Fotoposen auf den Berggipfeln strengstens untersagt?',
                    'Welche Müllvermeidungsregeln gelten für den Schutz der Batur-Caldera?',
                    'Welche spirituelle Bedeutung haben die heiligen Berge für den balinesischen Hinduismus?',
                ],
            ];
        }

        // Default: Sacred Temples & General Cultural Sanctuaries
        return [
            'id' => [
                'Apa ketentuan busana sopan adat (kamen & senteng) yang wajib dipatuhi di destinasi ini?',
                'Apakah saya boleh mengenakan celana pendek saat berkunjung ke kawasan ini?',
                'Bolehkah saya mengambil foto atau video saat upacara persembahyangan berlangsung?',
                'Aktivitas apa saja yang dilarang keras bagi wisatawan di kawasan ini?',
                'Apa saja aturan umum bagi wisatawan di seluruh Bali menurut SE Gubernur No. 4/2023?',
            ],
            'en' => [
                'What are the mandatory dress code requirements (kamen & senteng) for this destination?',
                'Can I wear shorts or casual beachwear when visiting this cultural area?',
                'Can I take photographs or videos while sacred ceremonies are taking place?',
                'What activities and behaviors are strictly prohibited for tourists in this sanctuary?',
                'What general guidelines must all tourists follow across Bali under Governor Circular No. 4/2023?',
            ],
            'zh' => [
                '进入本处目的地有哪些严格的传统着装要求（Kamen 沙龙与 Senteng 腰带）？',
                '参观这一文化圣地时可以穿短裤或休闲海滩服装吗？',
                '在神圣仪式与祈祷进行期间允许拍照或录制视频吗？',
                '游客在这一圣域区域严禁进行哪些破坏神圣性的行为？',
                '根据巴厘省长第4号通告，所有在巴厘岛旅游的访客必须遵守哪些总体规则？',
            ],
            'ja' => [
                'この目的地を訪れる際に必須となる伝統服装（サロンと帯）の規定は何ですか？',
                'この文化保護区を訪れる際、ショートパンツや軽装でも入場できますか？',
                '神聖な儀式や祈りが執り行われている最中に写真や動画を撮影できますか？',
                'この神聖な場所で観光客が固く禁止されている行為は何ですか？',
                'バリ州知事令第4号に基づき、バリ島全域で観光客が遵守すべき共通規則は何ですか？',
            ],
            'ru' => [
                'Каковы обязательные требования к традиционной одежде (камен и сентенг) в этом месте?',
                'Можно ли посещать эту культурную зону в шортах или пляжной одежде?',
                'Разрешено ли фотографировать или снимать видео во время священных церемоний?',
                'Какие действия и поведение строго запрещены для туристов на этой территории?',
                'Какие общие правила обязаны соблюдать все туристы на Бали согласно указу губернатора № 4/2023?',
            ],
            'fr' => [
                'Quelles sont les tenues traditionnelles obligatoires (kamen & senteng) pour ce lieu ?',
                'Puis-je porter un short ou une tenue de plage décontractée pour visiter ce site ?',
                'Est-il permis de prendre des photos ou vidéos pendant les cérémonies sacrées ?',
                'Quels comportements et activités sont formellement interdits dans cette zone ?',
                'Quelles sont les règles générales pour tous les touristes à Bali selon la circulaire n° 4/2023 ?',
            ],
            'de' => [
                'Welche Kleidungsvorschriften (Kamen & Senteng) müssen hier zwingend beachtet werden?',
                'Darf ich diesen Kulturort in kurzen Hosen oder lockerer Strandkleidung betreten?',
                'Darf während der heiligen Zeremonien und Gebete fotografiert oder gefilmt werden?',
                'Welche Verhaltensweisen sind für Touristen in diesem heiligen Bereich streng verboten?',
                'Welche allgemeinen Regeln gelten für alle Bali-Urlauber gemäß Gouverneurserlass Nr. 4/2023?',
            ],
        ];
    }
}
