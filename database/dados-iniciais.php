<?php
// =====================================================================
// DADOS INICIAIS ("seed")
// O instalar.php lê este arquivo e coloca tudo no banco.
// Depois de instalado, você pode cadastrar mais coisas pelo /admin.
// Nos livros e posts, "autor" é o SLUG do autor (o instalar.php
// troca pelo id certo).
// =====================================================================

return [

    // -----------------------------------------------------------------
    // AUTORES
    // -----------------------------------------------------------------
    'autores' => [
        [
            'slug' => 'bell-hooks',
            'fonte_url' => 'https://pt.wikipedia.org/wiki/bell_hooks',
            'nome' => 'bell hooks',
            'nome_completo' => 'Gloria Jean Watkins',
            'nascimento' => 1952,
            'falecimento' => 2021,
            'local_nascimento' => 'Hopkinsville, Kentucky',
            'nacionalidade' => 'Estados Unidos',
            'foto' => 'bell_hooks.jpg',
            'foto_posicao' => '40% 15%',
            'foto_credito' => 'Alex Lozupone (Tduk) · CC BY-SA 4.0 · Wikimedia Commons',
            'cor' => '#FF8A65',
            'resumo' => 'Escritora, professora e ativista. Uma das principais vozes do feminismo negro.',
            'biografia' => "bell hooks foi uma escritora, professora e ativista norte-americana. Ela escolheu escrever o nome em letras minúsculas porque queria que a atenção estivesse nas ideias, e não em quem as escrevia.\n\nSua obra aborda feminismo, racismo, educação e relações sociais. Tornou-se uma das principais vozes do feminismo negro contemporâneo e influenciou debates sobre amor, cultura e liberdade.\n\nEscreveu dezenas de livros, entre ensaios, livros infantis e poesia, sempre com uma linguagem acessível, porque acreditava que o conhecimento precisa chegar a todo mundo.",
            'citacao' => 'O amor é o que o amor faz.',
            'citacao_fonte' => 'Tudo sobre o amor (2000), capítulo 2',
            'citacao_url' => 'https://outraspalavras.net/crise-civilizatoria/amor-e-sua-etica-segundo-bell-hooks/',
        ],
        [
            'slug' => 'angela-davis',
            'fonte_url' => 'https://pt.wikipedia.org/wiki/Angela_Davis',
            'nome' => 'Angela Davis',
            'nome_completo' => 'Angela Yvonne Davis',
            'nascimento' => 1944,
            'local_nascimento' => 'Birmingham, Alabama',
            'nacionalidade' => 'Estados Unidos',
            'foto' => 'angela_davis.jpg',
            'foto_posicao' => 'center 25%',
            'foto_credito' => 'Bernard Gotfryd · Domínio público · Wikimedia Commons',
            'cor' => '#9C7BFF',
            'resumo' => 'Filósofa, professora e ativista. Referência mundial na luta por direitos civis.',
            'biografia' => "Angela Davis é filósofa, professora e ativista política. Nasceu em Birmingham, no Alabama, uma cidade marcada pela segregação racial.\n\nSuas obras discutem racismo, desigualdade social, feminismo e o sistema prisional. Tornou-se uma referência mundial nos movimentos de direitos civis e justiça social.\n\nFoi professora da Universidade da Califórnia e continua sendo uma das intelectuais mais citadas quando o assunto é liberdade e antirracismo.",
        ],
        [
            'slug' => 'jout-jout',
            'fonte_url' => 'https://pt.wikipedia.org/wiki/Jout_Jout',
            'nome' => 'Jout Jout',
            'nome_completo' => 'Julia Tolezano da Veiga Faria',
            'nacionalidade' => 'Brasil',
            'foto' => 'jout_jout.jpg',
            'foto_posicao' => '62% 20%',
            'foto_credito' => 'TEDx Parque das Nações Women · CC BY 2.0 · Wikimedia Commons',
            'cor' => '#FFC24B',
            'resumo' => 'Escritora e criadora de conteúdo. Fala de saúde mental e cotidiano com muito humor.',
            'biografia' => "Jout Jout é o apelido de Julia Tolezano, escritora, jornalista e criadora de conteúdo brasileira.\n\nFicou conhecida pelo canal no YouTube onde abordava saúde mental, relacionamentos e cotidiano de maneira leve e reflexiva.\n\nEm 2016 lançou seu primeiro livro, “Tá todo mundo mal”, que entrou para a lista dos mais vendidos do país.",
        ],
        [
            'slug' => 'ana-maria-goncalves',
            'fonte_url' => 'https://pt.wikipedia.org/wiki/Ana_Maria_Gonçalves',
            'nome' => 'Ana Maria Gonçalves',
            'nascimento' => 1970,
            'local_nascimento' => 'Ibiá, Minas Gerais',
            'nacionalidade' => 'Brasil',
            'foto' => 'ana_maria_goncalves.jpg',
            'foto_posicao' => '33% 25%',
            'foto_credito' => 'Valter Campanato/Agência Brasil · CC BY 3.0 BR · Wikimedia Commons',
            'cor' => '#4DB6AC',
            'resumo' => 'Escritora e roteirista, autora de um dos romances mais importantes do Brasil.',
            'biografia' => "Ana Maria Gonçalves é escritora e roteirista brasileira, nascida em Ibiá, Minas Gerais.\n\nTornou-se amplamente reconhecida pelo romance “Um defeito de cor”, publicado em 2006 e considerado uma das obras mais importantes da literatura brasileira contemporânea.\n\nSeus trabalhos valorizam memória, ancestralidade e identidade negra. Tornou-se a primeira mulher negra a integrar a Academia Brasileira de Letras, onde ocupa a cadeira 33.",
        ],
        [
            'slug' => 'conceicao-evaristo',
            'fonte_url' => 'https://pt.wikipedia.org/wiki/Conceição_Evaristo',
            'nome' => 'Conceição Evaristo',
            'nome_completo' => 'Maria da Conceição Evaristo de Brito',
            'nascimento' => 1946,
            'local_nascimento' => 'Belo Horizonte, Minas Gerais',
            'nacionalidade' => 'Brasil',
            'foto' => 'conceicao_evaristo.jpg',
            'foto_posicao' => 'center 20%',
            'foto_credito' => 'Lula Oficial · CC BY-SA 2.0 · Wikimedia Commons',
            'cor' => '#E57373',
            'resumo' => 'Escritora e linguista, criadora do conceito de “escrevivência”.',
            'biografia' => "Conceição Evaristo nasceu numa favela de Belo Horizonte e trabalhou como empregada doméstica antes de se mudar para o Rio de Janeiro, onde se formou professora e, depois, doutora em Literatura.\n\nÉ a criadora do conceito de “escrevivência”: uma escrita que nasce da vivência, especialmente da experiência das mulheres negras no Brasil.\n\nSeus romances, contos e poemas são estudados em escolas e universidades do país inteiro. O livro de contos “Olhos d'água” venceu o Prêmio Jabuti em 2015.",
            'citacao' => 'A nossa escrevivência não pode ser lida como histórias para “ninar os da casa-grande” e sim para incomodá-los em seus sonos injustos.',
            'citacao_fonte' => 'Sobre o conceito de escrevivência',
            'citacao_url' => 'https://fpabramo.org.br/2018/09/04/para-incomodar-o-sono-dos-injuntos-olhos-dagua',
        ],
        [
            'slug' => 'djamila-ribeiro',
            'fonte_url' => 'https://pt.wikipedia.org/wiki/Djamila_Ribeiro',
            'nome' => 'Djamila Ribeiro',
            'nome_completo' => 'Djamila Taís Ribeiro dos Santos',
            'nascimento' => 1980,
            'local_nascimento' => 'Santos, São Paulo',
            'nacionalidade' => 'Brasil',
            'foto' => 'djamila_ribeiro.jpg',
            'foto_posicao' => '55% 30%',
            'foto_credito' => 'Agência PT · CC BY 3.0 · Wikimedia Commons',
            'cor' => '#BA68C8',
            'resumo' => 'Filósofa e ativista que levou o debate antirracista para o grande público.',
            'biografia' => "Djamila Ribeiro é filósofa, escritora e professora. É mestre em Filosofia Política e uma das intelectuais mais conhecidas do Brasil.\n\nCoordena a coleção “Feminismos Plurais”, que publica livros curtos e baratos de autoras e autores negros, para que mais gente tenha acesso a esses debates.\n\nO “Pequeno manual antirracista” venceu o Prêmio Jabuti em 2020. Em 2023 recebeu o Prêmio Franco-Alemão de Direitos Humanos.",
        ],
        [
            'slug' => 'chimamanda-ngozi-adichie',
            'fonte_url' => 'https://pt.wikipedia.org/wiki/Chimamanda_Ngozi_Adichie',
            'nome' => 'Chimamanda Ngozi Adichie',
            'nascimento' => 1977,
            'local_nascimento' => 'Enugu, Nigéria',
            'nacionalidade' => 'Nigéria',
            'foto' => 'chimamanda_adichie.jpg',
            'foto_posicao' => 'center 15%',
            'foto_credito' => 'Slowking · GFDL 1.2 · Wikimedia Commons',
            'cor' => '#26A69A',
            'resumo' => 'Romancista nigeriana, autora de “Americanah” e de palestras que viraram livros.',
            'biografia' => "Chimamanda Ngozi Adichie é uma escritora nigeriana, considerada uma das vozes mais importantes da literatura africana contemporânea.\n\nFicou mundialmente famosa com duas palestras: “O perigo de uma história única” e “Sejamos todos feministas”. A segunda até foi usada pela cantora Beyoncé na música “Flawless”.\n\nSeus romances falam de identidade, imigração, racismo e amor, entre a Nigéria, os Estados Unidos e a Inglaterra.",
            'citacao' => 'A história única cria estereótipos. E o problema com os estereótipos não é que sejam mentira, mas que são incompletos.',
            'citacao_fonte' => 'Palestra “O perigo de uma história única” (TED, 2009)',
            'citacao_url' => 'https://www.ted.com/talks/chimamanda_ngozi_adichie_the_danger_of_a_single_story',
        ],
        [
            'slug' => 'carolina-maria-de-jesus',
            'fonte_url' => 'https://pt.wikipedia.org/wiki/Carolina_Maria_de_Jesus',
            'nome' => 'Carolina Maria de Jesus',
            'nascimento' => 1914,
            'falecimento' => 1977,
            'local_nascimento' => 'Sacramento, Minas Gerais',
            'nacionalidade' => 'Brasil',
            'foto' => 'carolina_maria_de_jesus.jpg',
            'foto_credito' => 'Domínio público · Wikimedia Commons',
            'cor' => '#8D6E63',
            'resumo' => 'Escritora que transformou seus diários na favela num clássico da literatura.',
            'biografia' => "Carolina Maria de Jesus estudou apenas dois anos na escola, mas nunca parou de ler e escrever. Morando na favela do Canindé, em São Paulo, catava papel para sustentar os três filhos e escrevia diários em cadernos que encontrava no lixo.\n\nEm 1960 esses diários viraram o livro “Quarto de despejo”, que vendeu centenas de milhares de exemplares e foi traduzido para mais de uma dezena de idiomas.\n\nHoje é considerada uma das escritoras mais importantes do Brasil, e sua obra continua sendo estudada e republicada.",
            'citacao' => 'O Brasil precisa ser dirigido por uma pessoa que já passou fome. A fome também é professora.',
            'citacao_fonte' => 'Quarto de despejo (1960)',
            'citacao_url' => 'https://lcl-cienciaaberta.pucsp.br/wp-content/uploads/2024/03/Podcast-Quarto-de-despejo-_Carolina-M.-de-Jesus.pdf',
        ],
        [
            'slug' => 'lelia-gonzalez',
            'fonte_url' => 'https://pt.wikipedia.org/wiki/Lélia_Gonzalez',
            'nome' => 'Lélia Gonzalez',
            'nascimento' => 1935,
            'falecimento' => 1994,
            'local_nascimento' => 'Belo Horizonte, Minas Gerais',
            'nacionalidade' => 'Brasil',
            'foto' => 'lelia_gonzalez.jpg',
            'foto_posicao' => 'center 30%',
            'foto_credito' => 'Cezar Loureiro · Domínio público · Wikimedia Commons',
            'cor' => '#F06292',
            'resumo' => 'Filósofa e antropóloga, pioneira do feminismo negro no Brasil.',
            'biografia' => "Lélia Gonzalez foi intelectual, professora, filósofa e antropóloga. É considerada uma das principais autoras do feminismo negro no Brasil e na América Latina.\n\nAjudou a fundar o Movimento Negro Unificado e o Instituto de Pesquisas das Culturas Negras, no Rio de Janeiro.\n\nCriou conceitos como “amefricanidade” e “pretuguês”, mostrando como as culturas africanas e indígenas moldaram o jeito de falar e de viver no Brasil.",
        ],
        [
            'slug' => 'luiz-antonio-simas',
            'fonte_url' => 'https://pt.wikipedia.org/wiki/Luiz_Antonio_Simas',
            'nome' => 'Luiz Antonio Simas',
            'nascimento' => 1967,
            'local_nascimento' => 'Rio de Janeiro',
            'nacionalidade' => 'Brasil',
            'foto' => null, // sem foto livre: aparece um avatar. Envie uma pelo /admin!
            'cor' => '#FF7043',
            'resumo' => 'Historiador e professor que escreve sobre ruas, sambas, terreiros e o Brasil encantado.',
            'biografia' => "Luiz Antonio Simas é escritor, professor, historiador e compositor carioca. É babalaô no culto de Ifá.\n\nEscreve sobre cultura brasileira, história social, filosofia popular e religiosidades, especialmente sobre aquilo que acontece nas ruas: o samba, o botequim, a festa, o terreiro.\n\nCom Nei Lopes escreveu o “Dicionário da história social do samba”, vencedor do Prêmio Jabuti. Com Luiz Rufino, escreveu “Fogo no mato”.",
        ],
        [
            'slug' => 'itamar-vieira-junior',
            'fonte_url' => 'https://pt.wikipedia.org/wiki/Itamar_Vieira_Junior',
            'nome' => 'Itamar Vieira Junior',
            'nascimento' => 1979,
            'local_nascimento' => 'Salvador, Bahia',
            'nacionalidade' => 'Brasil',
            'foto' => 'itamar_vieira_junior.jpg',
            'foto_posicao' => '35% 25%',
            'foto_credito' => 'André Koehne · CC BY-SA 4.0 · Wikimedia Commons',
            'cor' => '#A1887F',
            'resumo' => 'Autor de “Torto arado”, um dos romances brasileiros mais lidos dos últimos anos.',
            'biografia' => "Itamar Vieira Junior é escritor e geógrafo, doutor em Estudos Étnicos e Africanos.\n\nTrabalhou por muitos anos com comunidades quilombolas e trabalhadores rurais no interior da Bahia, experiência que inspira seus livros.\n\n“Torto arado” venceu os prêmios LeYa (2018), Jabuti (2020) e Oceanos (2020) e se tornou um fenômeno de leitura no Brasil.",
        ],
        [
            'slug' => 'jeferson-tenorio',
            'fonte_url' => 'https://pt.wikipedia.org/wiki/Jeferson_Tenório',
            'nome' => 'Jeferson Tenório',
            'nascimento' => 1977,
            'local_nascimento' => 'Rio de Janeiro',
            'nacionalidade' => 'Brasil',
            'foto' => 'jeferson_tenorio.jpg',
            'foto_posicao' => 'center 15%',
            'foto_credito' => 'Ederson Nunes/CMPA · Wikimedia Commons',
            'cor' => '#5C6BC0',
            'resumo' => 'Escritor e professor, autor do premiado “O avesso da pele”.',
            'biografia' => "Jeferson Tenório é escritor, professor e pesquisador. Nasceu no Rio de Janeiro e vive em Porto Alegre.\n\nEstreou com o romance “O beijo na parede” (2013), eleito Livro do Ano pela Associação Gaúcha de Escritores.\n\n“O avesso da pele”, sobre um filho que reconstrói a história do pai, um professor negro morto numa abordagem policial, venceu o Prêmio Jabuti em 2021.",
        ],
        [
            'slug' => 'ailton-krenak',
            'fonte_url' => 'https://pt.wikipedia.org/wiki/Ailton_Krenak',
            'nome' => 'Ailton Krenak',
            'nome_completo' => 'Ailton Alves Lacerda Krenak',
            'nascimento' => 1953,
            'local_nascimento' => 'Itabirinha, Minas Gerais',
            'nacionalidade' => 'Brasil',
            'foto' => 'ailton_krenak.jpg',
            'foto_posicao' => 'center 20%',
            'foto_credito' => 'Produção Cultural no Brasil · CC BY-SA 2.0 · Wikimedia Commons',
            'cor' => '#66BB6A',
            'resumo' => 'Líder indígena, pensador e escritor. Primeiro indígena da Academia Brasileira de Letras.',
            'biografia' => "Ailton Krenak é líder indígena, ambientalista, pensador, poeta e escritor do povo Krenak, do vale do rio Doce.\n\nFicou conhecido em 1987, quando pintou o rosto com tinta de jenipapo durante um discurso na Assembleia Constituinte, em defesa dos direitos indígenas.\n\nSeus livros curtos e poderosos questionam a ideia de progresso e nos convidam a repensar a relação com a natureza. Foi o primeiro indígena eleito para a Academia Brasileira de Letras.",
            'citacao' => 'Minha provocação sobre adiar o fim do mundo é exatamente sempre poder contar mais uma história.',
            'citacao_fonte' => 'Ideias para adiar o fim do mundo (2019)',
            'citacao_url' => 'https://www.companhiadasletras.com.br/livro/9788535933581/ideias-para-adiar-o-fim-do-mundo-nova-edicao',
        ],
        [
            'slug' => 'nei-lopes',
            'fonte_url' => 'https://pt.wikipedia.org/wiki/Nei_Lopes',
            'nome' => 'Nei Lopes',
            'nome_completo' => 'Nei Braz Lopes',
            'nascimento' => 1942,
            'local_nascimento' => 'Rio de Janeiro',
            'nacionalidade' => 'Brasil',
            'foto' => 'nei_lopes.jpg',
            'foto_posicao' => '38% 20%',
            'foto_credito' => 'TV Brasil · CC BY 3.0 BR · Wikimedia Commons',
            'cor' => '#FFB300',
            'resumo' => 'Sambista, compositor e estudioso das culturas africanas e da diáspora.',
            'biografia' => "Nei Lopes é compositor, cantor, escritor e um dos maiores estudiosos das culturas africanas no Brasil.\n\nTem centenas de sambas gravados por grandes nomes da música brasileira e escreveu dicionários, enciclopédias, romances e livros de poesia.\n\nSua “Enciclopédia brasileira da diáspora africana” é uma obra de referência para quem estuda a presença africana no Brasil.",
        ],
    ],

    // -----------------------------------------------------------------
    // LIVROS
    // -----------------------------------------------------------------
    'livros' => [
        // bell hooks
        ['autor' => 'bell-hooks', 'titulo' => 'Ensinando a Transgredir', 'ano' => 1994, 'cor' => '#FF8A65', 'destaque' => 1,
         'sinopse' => 'Reflexões sobre educação crítica, liberdade e transformação social dentro da sala de aula.'],
        ['autor' => 'bell-hooks', 'titulo' => 'Tudo sobre o amor', 'ano' => 2000, 'cor' => '#F06292', 'destaque' => 1,
         'sinopse' => 'Discussão sobre amor, afeto e relações humanas em uma sociedade marcada por desigualdades.'],
        ['autor' => 'bell-hooks', 'titulo' => 'Olhares Negros', 'ano' => 1992, 'cor' => '#5C6BC0',
         'sinopse' => 'Análise sobre representações raciais, cultura e identidade negra na mídia e na sociedade.'],
        ['autor' => 'bell-hooks', 'titulo' => 'E eu não sou uma mulher?', 'ano' => 1981, 'cor' => '#FFB74D',
         'sinopse' => 'Debate sobre racismo, feminismo e o impacto histórico da opressão sobre mulheres negras.'],

        // Angela Davis
        ['autor' => 'angela-davis', 'titulo' => 'Mulheres, Raça e Classe', 'ano' => 1981, 'cor' => '#9C7BFF', 'destaque' => 1,
         'sinopse' => 'Estudo sobre a relação entre racismo, capitalismo e desigualdade de gênero.'],
        ['autor' => 'angela-davis', 'titulo' => 'A Liberdade é uma Luta Constante', 'ano' => 2015, 'cor' => '#E57373',
         'sinopse' => 'Reflexões políticas sobre liberdade, resistência e movimentos sociais contemporâneos.'],
        ['autor' => 'angela-davis', 'titulo' => 'Mulheres, Cultura e Política', 'ano' => 1989, 'cor' => '#4DB6AC',
         'sinopse' => 'Coletânea de discursos e ensaios sobre feminismo, racismo e transformação social.'],
        ['autor' => 'angela-davis', 'titulo' => 'Estarão as Prisões Obsoletas?', 'ano' => 2003, 'cor' => '#7986CB',
         'sinopse' => 'Discussão crítica sobre o sistema prisional e alternativas ao encarceramento em massa.'],

        // Jout Jout
        ['autor' => 'jout-jout', 'titulo' => 'Tá todo mundo mal', 'ano' => 2016, 'cor' => '#FFC24B',
         'sinopse' => 'Reflexões sobre ansiedade, relacionamentos e as pequenas crises da vida adulta, com muito humor.'],

        // Ana Maria Gonçalves
        ['autor' => 'ana-maria-goncalves', 'titulo' => 'Um defeito de cor', 'ano' => 2006, 'cor' => '#26A69A', 'destaque' => 1,
         'sinopse' => 'Romance histórico que acompanha a trajetória de Kehinde, uma mulher africana escravizada no Brasil.'],
        ['autor' => 'ana-maria-goncalves', 'titulo' => 'Ao lado e à margem do que sentes por mim', 'ano' => 2002, 'cor' => '#80CBC4',
         'sinopse' => 'O primeiro romance da autora, uma história de amor contada com delicadeza e ousadia.'],

        // Conceição Evaristo
        ['autor' => 'conceicao-evaristo', 'titulo' => 'Ponciá Vicêncio', 'ano' => 2003, 'cor' => '#E57373', 'destaque' => 1,
         'sinopse' => 'A trajetória de uma mulher negra entre o interior e a cidade, carregando as marcas da memória familiar.'],
        ['autor' => 'conceicao-evaristo', 'titulo' => 'Olhos d\'água', 'ano' => 2014, 'cor' => '#4FC3F7',
         'sinopse' => 'Contos sobre mães, filhas e mulheres negras que resistem à violência e à pobreza com afeto e coragem.'],
        ['autor' => 'conceicao-evaristo', 'titulo' => 'Becos da memória', 'ano' => 2006, 'cor' => '#AD1457',
         'sinopse' => 'As histórias dos moradores de uma favela prestes a ser demolida, contadas pela menina Maria-Nova.'],

        // Djamila Ribeiro
        ['autor' => 'djamila-ribeiro', 'titulo' => 'Pequeno manual antirracista', 'ano' => 2019, 'cor' => '#BA68C8', 'destaque' => 1,
         'sinopse' => 'Onze lições curtas e diretas sobre como combater o racismo no dia a dia.'],
        ['autor' => 'djamila-ribeiro', 'titulo' => 'O que é lugar de fala?', 'ano' => 2017, 'cor' => '#7E57C2',
         'sinopse' => 'Uma explicação clara sobre o conceito de lugar de fala e por que diversidade de vozes importa.'],
        ['autor' => 'djamila-ribeiro', 'titulo' => 'Quem tem medo do feminismo negro?', 'ano' => 2018, 'cor' => '#EC407A',
         'sinopse' => 'Ensaio autobiográfico e artigos que apresentam as bases do feminismo negro.'],

        // Chimamanda
        ['autor' => 'chimamanda-ngozi-adichie', 'titulo' => 'Americanah', 'ano' => 2013, 'cor' => '#26A69A', 'destaque' => 1,
         'sinopse' => 'Ifemelu deixa a Nigéria para estudar nos EUA e descobre o que significa ser negra na América.'],
        ['autor' => 'chimamanda-ngozi-adichie', 'titulo' => 'Sejamos todos feministas', 'ano' => 2014, 'cor' => '#FFCA28',
         'sinopse' => 'A versão em livro da palestra que explica, de um jeito simples, por que o feminismo é para todo mundo.'],
        ['autor' => 'chimamanda-ngozi-adichie', 'titulo' => 'Hibisco roxo', 'ano' => 2003, 'cor' => '#8E24AA',
         'sinopse' => 'Kambili, uma adolescente nigeriana, cresce sob o controle de um pai religioso e autoritário.'],
        ['autor' => 'chimamanda-ngozi-adichie', 'titulo' => 'Meio sol amarelo', 'ano' => 2006, 'cor' => '#FFA000',
         'sinopse' => 'Um romance sobre amor e sobrevivência durante a guerra de Biafra, na Nigéria.'],

        // Carolina Maria de Jesus
        ['autor' => 'carolina-maria-de-jesus', 'titulo' => 'Quarto de despejo', 'ano' => 1960, 'cor' => '#8D6E63', 'destaque' => 1,
         'sinopse' => 'O diário de uma catadora de papel na favela do Canindé, em São Paulo. Um clássico da literatura brasileira.'],
        ['autor' => 'carolina-maria-de-jesus', 'titulo' => 'Casa de alvenaria', 'ano' => 1961, 'cor' => '#BCAAA4',
         'sinopse' => 'A continuação dos diários: a vida de Carolina depois do sucesso de “Quarto de despejo”.'],

        // Lélia Gonzalez
        ['autor' => 'lelia-gonzalez', 'titulo' => 'Por um feminismo afro-latino-americano', 'ano' => 2020, 'cor' => '#F06292',
         'sinopse' => 'Reunião de ensaios, intervenções e diálogos fundamentais de Lélia Gonzalez.'],
        ['autor' => 'lelia-gonzalez', 'titulo' => 'Lugar de negro', 'ano' => 1982, 'coautoria' => 'com Carlos Hasenbalg', 'cor' => '#C2185B',
         'sinopse' => 'Uma análise do movimento negro brasileiro e da desigualdade racial no país.'],

        // Luiz Antonio Simas
        ['autor' => 'luiz-antonio-simas', 'titulo' => 'O corpo encantado das ruas', 'ano' => 2019, 'cor' => '#FF7043', 'destaque' => 1,
         'sinopse' => 'Crônicas sobre as ruas, as festas, os botequins e as culturas que encantam o cotidiano brasileiro.'],
        ['autor' => 'luiz-antonio-simas', 'titulo' => 'Fogo no mato', 'ano' => 2018, 'coautoria' => 'com Luiz Rufino', 'cor' => '#D84315',
         'sinopse' => 'A ciência encantada das macumbas: saberes de terreiro como formas de conhecimento.'],
        ['autor' => 'luiz-antonio-simas', 'titulo' => 'Pedrinhas miudinhas', 'ano' => 2013, 'cor' => '#FFAB91',
         'sinopse' => 'Ensaios sobre ruas, aldeias e terreiros, e sobre o Brasil que acontece fora dos livros oficiais.'],
        ['autor' => 'luiz-antonio-simas', 'titulo' => 'Umbandas: uma história do Brasil', 'ano' => 2021, 'cor' => '#6D4C41',
         'sinopse' => 'A história da umbanda contada como uma forma de entender a própria formação do Brasil.'],

        // Itamar Vieira Junior
        ['autor' => 'itamar-vieira-junior', 'titulo' => 'Torto arado', 'ano' => 2019, 'cor' => '#A1887F', 'destaque' => 1,
         'sinopse' => 'As irmãs Bibiana e Belonísia e a luta pela terra no sertão da Bahia.'],
        ['autor' => 'itamar-vieira-junior', 'titulo' => 'Salvar o fogo', 'ano' => 2023, 'cor' => '#E64A19',
         'sinopse' => 'Na beira do rio Paraguaçu, Luzia e o irmão Moisés enfrentam os segredos de uma comunidade dominada por um mosteiro.'],

        // Jeferson Tenório
        ['autor' => 'jeferson-tenorio', 'titulo' => 'O avesso da pele', 'ano' => 2020, 'cor' => '#5C6BC0',
         'sinopse' => 'Pedro reconstrói a história do pai, um professor negro morto numa abordagem policial.'],
        ['autor' => 'jeferson-tenorio', 'titulo' => 'Estela sem Deus', 'ano' => 2018, 'cor' => '#3949AB',
         'sinopse' => 'Uma menina negra que quer ser filósofa tenta entender o mundo enquanto se muda de cidade em cidade.'],
        ['autor' => 'jeferson-tenorio', 'titulo' => 'O beijo na parede', 'ano' => 2013, 'cor' => '#9FA8DA',
         'sinopse' => 'O romance de estreia do autor, sobre um menino que perde tudo e precisa recomeçar.'],

        // Ailton Krenak
        ['autor' => 'ailton-krenak', 'titulo' => 'Ideias para adiar o fim do mundo', 'ano' => 2019, 'cor' => '#66BB6A', 'destaque' => 1,
         'sinopse' => 'Três falas curtas que questionam a ideia de humanidade separada da natureza.'],
        ['autor' => 'ailton-krenak', 'titulo' => 'A vida não é útil', 'ano' => 2020, 'cor' => '#43A047',
         'sinopse' => 'Reflexões sobre o consumo, o trabalho e a forma como vivemos, escritas durante a pandemia.'],
        ['autor' => 'ailton-krenak', 'titulo' => 'Futuro ancestral', 'ano' => 2022, 'cor' => '#00897B',
         'sinopse' => 'Rios, florestas e ancestralidade como caminhos para imaginar outros futuros.'],

        // Nei Lopes
        ['autor' => 'nei-lopes', 'titulo' => 'Dicionário da história social do samba', 'ano' => 2015, 'coautoria' => 'com Luiz Antonio Simas', 'cor' => '#FFB300',
         'sinopse' => 'Verbetes sobre gente, lugares, festas e expressões que fazem a história do samba. Vencedor do Jabuti.'],
        ['autor' => 'nei-lopes', 'titulo' => 'Enciclopédia brasileira da diáspora africana', 'ano' => 2004, 'cor' => '#F57F17',
         'sinopse' => 'Uma obra de referência sobre a presença africana na história e na cultura brasileira.'],
    ],

    // -----------------------------------------------------------------
    // POSTS DO BLOG
    // -----------------------------------------------------------------
    'posts' => [
        [
            'slug' => 'simas-e-o-encanto-das-ruas',
            'titulo' => 'Luiz Antonio Simas e o encanto das ruas',
            'publicado_em' => '2026-10-14',
            'autor' => 'luiz-antonio-simas',
            'emoji' => '🥁',
            'resumo' => 'Samba, botequim, festa de santo: por que a rua é a grande sala de aula do Simas.',
            'conteudo' => "Se você acha que história se aprende só em livro didático, o Simas vai mudar a sua cabeça. Para ele, a rua é um lugar de conhecimento: tem saber na roda de samba, na feira, no terreiro e na esquina.\n\n“O corpo encantado das ruas” é uma ótima porta de entrada. São textos curtos, quase crônicas, que dá para ler um por dia.\n\nE se gostar, vá para “Fogo no mato”, escrito com Luiz Rufino, e para o “Dicionário da história social do samba”, que ele fez com o mestre Nei Lopes.",
        ],
        [
            'slug' => 'o-que-e-escrevivencia',
            'titulo' => 'Afinal, o que é “escrevivência”?',
            'publicado_em' => '2026-10-12',
            'autor' => 'conceicao-evaristo',
            'emoji' => '✍️',
            'resumo' => 'O conceito criado por Conceição Evaristo explicado de um jeito simples.',
            'conteudo' => "Escrevivência junta duas palavras: escrever e vivência. É a escrita que nasce da experiência de quem escreve, e de toda uma coletividade que vive situações parecidas.\n\nConceição Evaristo usa o termo para falar da literatura feita por mulheres negras, que durante muito tempo foram personagens das histórias dos outros e raramente as autoras.\n\nPara sentir na prática, comece por “Olhos d'água”: são contos curtos, intensos e inesquecíveis.",
        ],
        [
            'slug' => 'por-onde-comecar-bell-hooks',
            'titulo' => 'Por onde começar a ler bell hooks?',
            'publicado_em' => '2026-10-10',
            'autor' => 'bell-hooks',
            'emoji' => '💌',
            'resumo' => 'Um roteirinho para quem quer conhecer a obra dela sem se perder.',
            'conteudo' => "bell hooks escreveu muitos livros, e é normal ficar em dúvida sobre qual escolher primeiro. A boa notícia é que a escrita dela é muito acessível!\n\nNossa dica é começar por “Tudo sobre o amor”. Ele fala de um tema que todo mundo vive e mostra como o amor também é uma escolha e uma prática.\n\nDepois, se você gosta de educação, vá para “Ensinando a Transgredir”. E se quiser entender a base do pensamento feminista dela, “E eu não sou uma mulher?” é essencial.",
        ],
        [
            'slug' => 'torto-arado-e-o-avesso-da-pele',
            'titulo' => 'Dois romances brasileiros para ler já',
            'publicado_em' => '2026-10-07',
            'autor' => 'itamar-vieira-junior',
            'emoji' => '🌾',
            'resumo' => '“Torto arado” e “O avesso da pele”: dois livros que todo mundo está comentando.',
            'conteudo' => "“Torto arado”, de Itamar Vieira Junior, se passa no sertão da Bahia e acompanha duas irmãs ligadas por um acidente de infância. É sobre terra, trabalho e liberdade.\n\n“O avesso da pele”, de Jeferson Tenório, é narrado por um filho que tenta entender a vida do pai. É sobre racismo, educação e afeto entre homens negros.\n\nOs dois venceram o Prêmio Jabuti de romance e são perfeitos para clubes de leitura.",
        ],
        [
            'slug' => 'um-defeito-de-cor',
            'titulo' => 'Vale a pena encarar as 900 páginas de Um defeito de cor?',
            'publicado_em' => '2026-10-03',
            'autor' => 'ana-maria-goncalves',
            'emoji' => '📚',
            'resumo' => 'Spoiler: vale MUITO. A gente explica o porquê.',
            'conteudo' => "O tamanho assusta, a gente sabe. Mas “Um defeito de cor” é daqueles livros que você não quer que acabem.\n\nA história acompanha Kehinde, uma mulher africana trazida ao Brasil escravizada, e atravessa quase um século da história do país pelo olhar dela.\n\nDica de leitura: leia um capítulo por dia e anote os nomes das personagens. Em pouco tempo você vai estar completamente envolvida!",
        ],
        [
            'slug' => 'livros-para-dias-dificeis',
            'titulo' => 'Livros para os dias em que tá todo mundo mal',
            'publicado_em' => '2026-09-26',
            'autor' => 'jout-jout',
            'emoji' => '🌧️',
            'resumo' => 'Leituras leves (e profundas) para quando a semana pesou.',
            'conteudo' => "Tem dias que a gente só precisa de um livro que pareça uma conversa com uma amiga. É exatamente isso que a Jout Jout faz.\n\nEm “Tá todo mundo mal” ela fala de crises do dia a dia com humor e sinceridade, e você termina a leitura se sentindo menos sozinha.\n\nPara completar, “Tudo sobre o amor”, da bell hooks, é um ótimo abraço em forma de livro. E “Ideias para adiar o fim do mundo”, do Ailton Krenak, é curtinho e muda a forma de ver as coisas.",
        ],
    ],

    // -----------------------------------------------------------------
    // COMENTÁRIOS
    // -----------------------------------------------------------------
    // Os comentários começam vazios: só entram os que as pessoas escreverem no site.
    'comentarios' => [],

    // -----------------------------------------------------------------
    // USUÁRIO DO PAINEL (troque a senha depois!)
    // -----------------------------------------------------------------
    'usuarios' => [
        ['nome' => 'Manu', 'email' => 'admin@estante.local', 'senha' => 'estante123'],
    ],
];
