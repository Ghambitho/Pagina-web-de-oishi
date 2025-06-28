// Este archivo contiene los datos de los productos cargados desde el CSV

const allProductsData = [
    // Categoria: Entradas
    {
        categoria: "Entradas",
        nombre: "Sashimi 3 cortes",
        descripcion: "Salmón o atún",
        precio: 4000,
        id: 1
    },
    {
        categoria: "Entradas",
        nombre: "Niguiris de salmón 4 und",
        descripcion: "Deditos de arroz de sushi cubiertos de salmón",
        precio: 3800,
        id: 2
    },
    {
        categoria: "Entradas",
        nombre: "Sashimi mixto 3 cortes",
        descripcion: "Salmón y atún",
        precio: 4000,
        id: 3
    },
    {
        categoria: "Entradas",
        nombre: "Papas fritas pequeñas",
        descripcion: "Papas fritas pequeñas",
        precio: 3000,
        id: 4
    },
    {
        categoria: "Entradas",
        nombre: "Sashimi 6 cortes",
        descripcion: "Salmón o atún",
        precio: 7000,
        id: 5
    },
    {
        categoria: "Entradas",
        nombre: "Niguiris de camarón 4 und",
        descripcion: "Deditos de arroz cubiertos de camarón eby",
        precio: 3800,
        id: 6
    },
    {
        categoria: "Entradas",
        nombre: "Hosomakis",
        descripcion: "Rollitos de sushi en alga Noris con la proteína y queso crema",
        precio: 3000,
        id: 7
    },
    {
        categoria: "Entradas",
        nombre: "Sashimi mixto 9 cortes",
        descripcion: "Salmón y atún",
        precio: 9500,
        id: 8
    },
    {
        categoria: "Entradas",
        nombre: "Sashimi mixto 6 cortes",
        descripcion: "Salmón y atún",
        precio: 7000,
        id: 9
    },
    {
        categoria: "Entradas",
        nombre: "Niguiris rainbow 6 und",
        descripcion: "Niguiris de pescados surtidos y palta",
        precio: 4500,
        id: 10
    },
    {
        categoria: "Entradas",
        nombre: "Sashimi 9 cortes",
        descripcion: "Salmón o atún",
        precio: 9500,
        id: 11
    },

    // Categoria: Entradas calientes
    {
        categoria: "Entradas calientes",
        nombre: "Giozas de pollo, cerdo o verduras",
        descripcion: "Empanaditas chinas rellenas",
        precio: 5500,
        id: 12
    },
    {
        categoria: "Entradas calientes",
        nombre: "Champi cheese",
        descripcion: "5 unidades champiñones rellenos con una deliciosa mezcla de queso crema y verduras",
        precio: 5000,
        id: 13
    },
    {
        categoria: "Entradas calientes",
        nombre: "Ensalada marina",
        descripcion: "Lechuga, cortes fino de pescado y camarón, palta",
        precio: 5500,
        id: 14
    },
    {
        categoria: "Entradas calientes",
        nombre: "Ensalada dinamita",
        descripcion: "Deliciosa combinación de wakame y kanikama aderezados con un toque de salsa acevichada",
        precio: 5000,
        id: 15
    },
    {
        categoria: "Entradas calientes",
        nombre: "Croquetas de salmón",
        descripcion: "5 unidades croquetas de salmón con salsa tártara",
        precio: 5000,
        id: 16
    },
    {
        categoria: "Entradas calientes",
        nombre: "Wakame",
        descripcion: "Ricas algas marinas aderezadas",
        precio: 5000,
        id: 17
    },
    {
        categoria: "Entradas calientes",
        nombre: "Giozas de camarón 5 unidades",
        descripcion: "Empanaditas chinas rellenas de camarones",
        precio: 6500,
        id: 18
    },
    {
        categoria: "Entradas calientes",
        nombre: "Ensalada verde",
        descripcion: "Lechuga, palta, pepino, palmito, apio",
        precio: 6500,
        id: 19
    },
    {
        categoria: "Entradas calientes",
        nombre: "Pollo kids",
        descripcion: "5 unidades de tiritas de pollo apanado con salsa tártara o acevichada",
        precio: 5900,
        id: 20
    },
    {
        categoria: "Entradas calientes",
        nombre: "Arrollados primavera",
        descripcion: "5 unidades de arrollados primavera o de jamón y queso, con salsa soya o tery",
        precio: 6000,
        id: 21
    },
    {
        categoria: "Entradas calientes",
        nombre: "Eby furay",
        descripcion: "5 unidades de camarones apanados con salsa tártara",
        precio: 6000,
        id: 22
    },
    {
        categoria: "Entradas calientes",
        nombre: "Eby balls",
        descripcion: "5 unidades de bolitas de queso y camarón, apanados, con salsa fuji",
        precio: 6500,
        id: 23
    },
    {
        categoria: "Entradas calientes",
        nombre: "Eby cheese",
        descripcion: "5 unidades de camarones con queso crema, apanados, con salsa tártara",
        precio: 6500,
        id: 24
    },
    {
        categoria: "Entradas calientes",
        nombre: "Ensalada verde con pollo",
        descripcion: "Lechuga, palta, pepino, palmito, apio, trozos de pollo a la plancha",
        precio: 6500,
        id: 25
    },

    // Categoria: hand rolls
    {
        categoria: "hand rolls",
        nombre: "Promoción especial hand roll",
        descripcion: "4 hand rolls de pollo queso crema y cebollón\nPromo especiales días feriados",
        precio: 10000,
        id: 26
    },
    {
        categoria: "hand rolls",
        nombre: "Hand roll palmito",
        descripcion: "Queso crema, cebollín, palmito",
        precio: 4000,
        id: 27
    },
    {
        categoria: "hand rolls",
        nombre: "Hand roll champiñón",
        descripcion: "Queso crema, cebollín, champiñón apanado",
        precio: 4000,
        id: 28
    },
    {
        categoria: "hand rolls",
        nombre: "Hand roll de camarón",
        descripcion: "Rollo con camarones, queso crema, cebollín en panko",
        precio: 4500,
        id: 29
    },
    {
        categoria: "hand rolls",
        nombre: "Hand roll de pollo",
        descripcion: "Rollo con pollo, queso, cebollín en panko",
        precio: 4000,
        id: 30
    },
    {
        categoria: "hand rolls",
        nombre: "Hand roll salmón",
        descripcion: "Rollo de salmón, queso crema y cebollín en panko",
        precio: 4500,
        id: 31
    },
    {
        categoria: "hand rolls",
        nombre: "Hand roll sin proteína",
        descripcion: "Queso crema, cebollín, palta",
        precio: 4000,
        id: 32
    },
    {
        categoria: "hand rolls",
        nombre: "Hand roll de kanikama",
        descripcion: "Rollo de kanikama, queso crema, cebollín en panko",
        precio: 4500,
        id: 33
    },

    // Categoria: Rolls california
    {
        categoria: "Rolls california",
        nombre: "1 California roll",
        descripcion: "Kanikama,pepino,palta en masago",
        precio: 8000,
        id: 34
    },
    {
        categoria: "Rolls california",
        nombre: "2 Alaska roll",
        descripcion: "Salmón, queso crema, palta en sesamo",
        precio: 7000,
        id: 35
    },
    {
        categoria: "Rolls california",
        nombre: "3 Eby California",
        descripcion: "Camarón apanados, queso crema y cebollón en sesamo o ciboulette",
        precio: 7000,
        id: 36
    },
    {
        categoria: "Rolls california",
        nombre: "4 Chiken California",
        descripcion: "Pollo apanado, queso crema y cebollón en sesamo o ciboulette",
        precio: 6500,
        id: 37
    },
    {
        categoria: "Rolls california",
        nombre: "5 Tery California",
        descripcion: "Pollo Teriyaki, queso crema y pimentón en ciboulette o sésamo",
        precio: 6500,
        id: 38
    },
    {
        categoria: "Rolls california",
        nombre: "6 Tuna California",
        descripcion: "Atún,queso crema y pepino en mix de sésamo,ciboulette y massgo",
        precio: 6500,
        id: 39
    },
    {
        categoria: "Rolls california",
        nombre: "7 Eby fresh",
        descripcion: "Camarón, queso crema, palta en sesamo",
        precio: 7000,
        id: 40
    },
    {
        categoria: "Rolls california",
        nombre: "8 Mango California",
        descripcion: "Mango, queso crema, kanikama apanado, en sesamo o ciboulette",
        precio: 7500,
        id: 41
    },

    // Categoria: Rolls tradicionales
     {
        categoria: "Rolls tradicionales",
        nombre: "9.5 Avocado de camarón",
        descripcion: "Camarón, queso crema, palta",
        precio: 7000,
        id: 42
    },
    {
        categoria: "Rolls tradicionales",
        nombre: "9 Avocado de salmón",
        descripcion: "Salmón, queso crema en palta",
        precio: 7500,
        id: 43
    },
    {
        categoria: "Rolls tradicionales",
        nombre: "10 eby roll",
        descripcion: "Camarón, queso crema, palta en salmón",
        precio: 7000,
        id: 44
    },
    {
        categoria: "Rolls tradicionales",
        nombre: "11 maguro roll",
        descripcion: "Atún, palta,en queso crema",
        precio: 8000,
        id: 45
    },
    {
        categoria: "Rolls tradicionales",
        nombre: "12 chicken tery",
        descripcion: "Pollo Teriyaki, queso crema y cebollón en palta",
        precio: 6000,
        id: 46
    },
    {
        categoria: "Rolls tradicionales",
        nombre: "13 Chicken krispy",
        descripcion: "Pollo apanado,queso crema,cebollón en palta",
        precio: 7600,
        id: 47
    },
    {
        categoria: "Rolls tradicionales",
        nombre: "14 Zetsu",
        descripcion: "Pollo apanado, palta, cebollón en queso flameado con salsa tery",
        precio: 6000,
        id: 48
    },
    {
        categoria: "Rolls tradicionales",
        nombre: "15 eby sake roll",
        descripcion: "Salmón camarón apanados y cebollón envuelto en palta",
        precio: 6000,
        id: 49
    },
    {
        categoria: "Rolls tradicionales",
        nombre: "16 eby exotic",
        descripcion: "Camarón queso crema y mango envuelto en salmon",
        precio: 6000,
        id: 50
    },
    {
        categoria: "Rolls tradicionales",
        nombre: "17 eby cheese",
        descripcion: "Camarón apanado palta en queso crema flameado con salsa tery",
        precio: 5500,
        id: 51
    },
    {
        categoria: "Rolls tradicionales",
        nombre: "18.5 Killua",
        descripcion: "Pollo apanado, palta, cebollin en queso crema.",
        precio: 7000,
        id: 52
    },
    {
        categoria: "Rolls tradicionales",
        nombre: "18 ichiro roll",
        descripcion: "Salmón palta y cebollón envuelto en atún y salsa acebichada",
        precio: 6500,
        id: 53
    },

    // Categoria: Rolls de la casa oishi
    {
        categoria: "Rolls de la casa oishi",
        nombre: "19 Fuji roll",
        descripcion: "Camarón apanado queso crema con toppings de camarón tempura bañados con salsa fuji",
        precio: 5800,
        id: 54
    },
    {
        categoria: "Rolls de la casa oishi",
        nombre: "20 eby abocado",
        descripcion: "Salmón,camarón queso crema envuelto en palta",
        precio: 8000,
        id: 55
    },
    {
        categoria: "Rolls de la casa oishi",
        nombre: "21 Alaska fresh",
        descripcion: "Salmón,queso crema,mango,envuelto en palta y salmon",
        precio: 7500,
        id: 56
    },
    {
        categoria: "Rolls de la casa oishi",
        nombre: "22 maracuyá roll",
        descripcion: "Salmón tempura ,palta y tempura crispy ,envuelto en queso crema bañado en salsa maracuyá.",
        precio: 7500,
        id: 57
    },
    {
        categoria: "Rolls de la casa oishi",
        nombre: "23 smook cheese",
        descripcion: "Camarón apanado ,palta y cebollón envuelto en queso crema flameado coronado con chimichurri y salsa tery",
        precio: 7500,
        id: 58
    },
    {
        categoria: "Rolls de la casa oishi",
        nombre: "24 Lemon",
        descripcion: "Salmón tempura ,queso crema y palta envuelto en salmon fresco y coronado con finas rodajas de limón y bañado en salsa tery",
        precio: 7500,
        id: 59
    },
    {
        categoria: "Rolls de la casa oishi",
        nombre: "25 rainbow roll",
        descripcion: "Salmón ,atún ,queso crema y mango envuelto en plaquetas mixta",
        precio: 7000,
        id: 60
    },
    {
        categoria: "Rolls de la casa oishi",
        nombre: "26 Uzumaki roll",
        descripcion: "Salmón ahumado, queso crema,kanikama apanado en plátano con puntos de salsa dinamita y salsa tery",
        precio: 8000,
        id: 61
    },
    {
        categoria: "Rolls de la casa oishi",
        nombre: "27 futo rainbow",
        descripcion: "Atún, salmón, queso crema y mango envuelto en nori con salsa acevichada y toques de masago",
        precio: 8500,
        id: 62
    },
    {
        categoria: "Rolls de la casa oishi",
        nombre: "28 selva Green",
        descripcion: "Camarón tempura,palta, kanikama apanado en queso crema y wakame con salsa tery y salsa spicy",
        precio: 7500,
        id: 63
    },
    {
        categoria: "Rolls de la casa oishi",
        nombre: "29 tanjiro roll",
        descripcion: "Kanikama apanado, palta y cebollón en sesamo con topin de camarones gratinados con queso crema con salsa de la casa",
        precio: 7500,
        id: 64
    },
    {
        categoria: "Rolls de la casa oishi",
        nombre: "30 acevichado roll",
        descripcion: "Camarón apanado,palta en sesamo coronado con exquisito ceviche de reineta",
        precio: 7000,
        id: 65
    },
    {
        categoria: "Rolls de la casa oishi",
        nombre: "31.5 platano rol",
        descripcion: "Pollo, queso crema, cebollin en plátano",
        precio: 8000,
        id: 66
    },
    {
        categoria: "Rolls de la casa oishi",
        nombre: "31 Poseidón roll",
        descripcion: "Kanikama, palta,cebollón, coronado con Co gratinado de salmón y queso crema terminado con salsa tery",
        precio: 8000,
        id: 67
    },

    // Categoria: Hot roll
    {
        categoria: "Hot roll",
        nombre: "32 Sake hot",
        descripcion: "Salmón, queso crema,cebollón en panko",
        precio: 5500,
        id: 68
    },
    {
        categoria: "Hot roll",
        nombre: "33 eby hot",
        descripcion: "Camarón, queso crema, cebollón en panko",
        precio: 6500,
        id: 69
    },
    {
        categoria: "Hot roll",
        nombre: "34 tery hot",
        descripcion: "Pollo tery,queso crema, cebollón en panko",
        precio: 6500,
        id: 70
    },
    {
        categoria: "Hot roll",
        nombre: "35 chiken hot",
        descripcion: "Pollo apanado, queso crema, pimentón en panko",
        precio: 6500,
        id: 71
    },
    {
        categoria: "Hot roll",
        nombre: "36 Kani hot",
        descripcion: "Kanikama apanado, queso crema, en panko con ensalada de wakame y kanikama",
        precio: 7000,
        id: 72
    },
    {
        categoria: "Hot roll",
        nombre: "37 smook roll",
        descripcion: "Salmón ahumado, kanikama apanado,queso crema y palta en panko",
        precio: 6000,
        id: 73
    },
    {
        categoria: "Hot roll",
        nombre: "38 yasay hot",
        descripcion: "Champiñón tempura, queso crema, cebollón, palmito en panko",
        precio: 5000,
        id: 74
    },
    {
        categoria: "Hot roll",
        nombre: "39 oishi hot",
        descripcion: "Camarón apanado, queso crema, cebollón en panko . Con topin de camarones apanados, mayonesa, cebollón, un Toque picante con salsa Fuji y tery",
        precio: 5000,
        id: 75
    },
    {
        categoria: "Hot roll",
        nombre: "40 Valencia hot",
        descripcion: "Pescado blanco apanado, salmón ahumado, queso crema, en panko con topin de pasta dinamita y salsa tery",
        precio: 5500,
        id: 76
    },
    {
        categoria: "Hot roll",
        nombre: "41 osaki hot",
        descripcion: "Kanikama apanado,salmón ahumado,queso crema,palta, en panko con toppings de pescado blanco apanado,mayonesa,cebollón, un toque picante con salsa acevichado",
        precio: 5500,
        id: 77
    },
    {
        categoria: "Hot roll",
        nombre: "42 dinamita hot",
        descripcion: "Salmón tempura,palta en tempura con pasta dinamita un toque picante y salsa tery",
        precio: 6000,
        id: 78
    },
    {
        categoria: "Hot roll",
        nombre: "43 vulcan roll",
        descripcion: "camaron apqanado y palta en panko con topping de salmon gratinado con queso crema y salsa tery",
        precio: 5500,
        id: 79
    },
    {
        categoria: "Hot roll",
        nombre: "44 spicy hot",
        descripcion: "salmon, queso crema, palta en tempura con salsa spicy y sirasha",
        precio: 6000,
        id: 80
    },
    {
        categoria: "Hot roll",
        nombre: "45 acevichado hot",
        descripcion: "kanikama tempura y palta en pamko con delicioso ceviche de reineta",
        precio: 7000,
        id: 81
    },

    // Categoria: Rolls sin arroz
    {
        categoria: "Rolls sin arroz",
        nombre: "46 goku roll",
        descripcion: "salmon, atun, pescado blanco, queso cremay palta en nori con saqlsa acevichada y masago",
        precio: 6000,
        id: 82
    },
    {
        categoria: "Rolls sin arroz",
        nombre: "47 sake ligh",
        descripcion: "salmon, queso crema, mango, kanikama apanado, pepino en palta y salsa mayo maracuya",
        precio: 6000,
        id: 83
    },
    {
        categoria: "Rolls sin arroz",
        nombre: "48 itashi roll",
        descripcion: "salmon temporisado, queso crema, palta, kanikama apanado, cebolllin en platano y salsa tery",
        precio: 6500,
        id: 84
    },
    {
        categoria: "Rolls sin arroz",
        nombre: "49 chipo roll",
        descripcion: "pollo tery, queso crema, cebollin y tempura crispi en palta con salsa tery",
        precio: 6500,
        id: 85
    },
    {
        categoria: "Rolls sin arroz",
        nombre: "50 yamato roll",
        descripcion: "salmon, atun, lechuga, pepino, queso crema y cilantro en hoja de arroz y salza ponzu",
        precio: 10000,
        id: 86
    },
    {
        categoria: "Rolls sin arroz",
        nombre: "50.5 naruto roll",
        descripcion: "Salmon , camarón, kanikama apanado,queso crema, cebollin y palta, en plaqueta mixta de salmón y palta.",
        precio: 12000,
        id: 87
    },

    // Categoria: Hot vegetarianos
    {
        categoria: "Hot vegetarianos",
        nombre: "51 champi hot",
        descripcion: "champiñon, queso crema, cebollin en panko",
        precio: 12500,
        id: 88
    },
    {
        categoria: "Hot vegetarianos",
        nombre: "52 ceviche hot",
        descripcion: "mix de verduras en tempura en pamko con ceviche de champiñones",
        precio: 12000,
        id: 89
    },
    {
        categoria: "Hot vegetarianos",
        nombre: "53 kento hot",
        descripcion: "palmito, pepino, zanahoria tempura en panko con topin de verduras picaditas con salsa acevichadas",
        precio: 8000,
        id: 90
    },
    {
        categoria: "Hot vegetarianos",
        nombre: "54 palmito hot",
        descripcion: "palmito, palta, cebollin en panko con topin de verduras salteadas y papas al hilo",
        precio: 10000,
        id: 91
    },
    {
        categoria: "Hot vegetarianos",
        nombre: "55 guacamole vergan",
        descripcion: "champiñon tempura, pepino y cebollin en panko con toping de guacamole",
        precio: 10500,
        id: 92
    },
    {
        categoria: "Hot vegetarianos",
        nombre: "56 onion roll",
        descripcion: "palta, champiñon tempura, y cebollin en panko topin de aros de cebolla",
        precio: 10500,
        id: 93
    },

    // Categoria: Rolls vegetarianos
    {
        categoria: "Rolls vegetarianos",
        nombre: "57 namikaze roll",
        descripcion: "champiñon, queso crema y cebollin en sesamo",
        precio: 5000,
        id: 94
    },
    {
        categoria: "Rolls vegetarianos",
        nombre: "58 ghambito roll",
        descripcion: "vegetales temporizados, con queso crema en ciboulette",
        precio: 7000,
        id: 95
    },
    {
        categoria: "Rolls vegetarianos",
        nombre: "59 nagato roll",
        descripcion: "champiñon, queso crema, pimenton en palta con topping de cebolla caramelizada",
        precio: 7000,
        id: 96
    },
    {
        categoria: "Rolls vegetarianos",
        nombre: "60 platano roll",
        descripcion: "verduras tempura o queso crema cebollin en platano",
        precio: 7000,
        id: 97
    },
    {
        categoria: "Rolls vegetarianos",
        nombre: "61 Exotico roll",
        descripcion: "champiñon tempura mango y pepino en platano",
        precio: 7000,
        id: 98
    },
    {
        categoria: "Rolls vegetarianos",
        nombre: "62 champi avocado",
        descripcion: "champiñon queso pimenton en palta",
        precio: 3000,
        id: 99
    },
    {
        categoria: "Rolls vegetarianos",
        nombre: "63 minato roll",
        descripcion: "palmito queso crema pepino en mango y salsa de maracuya",
        precio: 7000,
        id: 100
    },
    {
        categoria: "Rolls vegetarianos",
        nombre: "64 primavera roll",
        descripcion: "lechuga queso crema mango palta pepino cilantro en hoja de arroz con salsa ponzu",
        precio: 7000,
        id: 101
    },
    {
        categoria: "Rolls vegetarianos",
        nombre: "65 tropical",
        descripcion: "palmito mango queso crema en palta",
        precio: 8000,
        id: 102
    },
    {
        categoria: "Rolls vegetarianos",
        nombre: "66 crispi vegan",
        descripcion: "champiñon tempura zanahoria tempura cebollin en palta con toping de tempura crispii",
        precio: 7000,
        id: 103
    },
    {
        categoria: "Rolls vegetarianos",
        nombre: "67vegeta",
        descripcion: "pepino palmito en palta con toping de verduras picadas en salsa acevichada y tempura crispi",
        precio: 7000,
        id: 104
    },
    {
        categoria: "Rolls vegetarianos",
        nombre: "68 ceviche vegan",
        descripcion: "palta cebolla y pepino en palta con toping de ceviche de champiñón",
        precio: 7000,
        id: 105
    },

    // Categoria: Ceviches y platos frios oishi
    {
        categoria: "Ceviches y platos frios oishi",
        nombre: "69 ceviche reineta",
        descripcion: "reineta fresca cebolla leche de tigre limon camote cocido canchita choclo peruano y cilantro",
        precio: 7500,
        id: 106
    },
    {
        categoria: "Ceviches y platos frios oishi",
        nombre: "70 ceviche mixto",
        descripcion: "finos cortes de reineta salmon y camarones leche de tigre limon camote cocido canchita choclo peruano y cilantro",
        precio: 7000,
        id: 107
    },
    {
        categoria: "Ceviches y platos frios oishi",
        nombre: "71 ceviche de salmon",
        descripcion: "salmon fresco cebolla leche de tigre limon camote cocido canchita choclo peruano y cilantro",
        precio: 7000,
        id: 108
    },
    {
        categoria: "Ceviches y platos frios oishi",
        nombre: "72 ceviche al aji amarillo",
        descripcion: "ceviche de reineta Y camaron en salsa acevichada con un toque de salsa de aji amarillo palta y cilantro",
        precio: 700,
        id: 109
    },
    {
        categoria: "Ceviches y platos frios oishi",
        nombre: "73 ceviche champiñon",
        descripcion: "champiñones frescos limon cebolla leche de tigre camote palta y cilantro",
        precio: 3800,
        id: 110
    },
    {
        categoria: "Ceviches y platos frios oishi",
        nombre: "74 palta acevichada",
        descripcion: "cuadritos de palta pimentón coronado con ceviche de reineta salsa de aji amarillo y un toque de masago",
        precio: 4500,
        id: 111
    },
    {
        categoria: "Ceviches y platos frios oishi",
        nombre: "75 tiraditos de salmon",
        descripcion: "12 finos cortes de salmon bañados en salsa especial oishi con un toque de salsa spice",
        precio: 1000,
        id: 112
    },
    {
        categoria: "Ceviches y platos frios oishi",
        nombre: "tiraditos de atun",
        descripcion: "finos cortes de atun con palta bañados en salsa especial oishi con toques de tongarashi y cilantro",
        precio: 5000,
        id: 113
    },

    // Categoria: Colaciones
    {
        categoria: "Colaciones",
        nombre: "arroz estilo venezolano cerdo",
        descripcion: "arroz salteado con huevo diente de dragón , cerdo ,zanahoria y cebollin aderezado con especias chinas salsa agridulce",
        precio: 4500,
        id: 114
    },
    {
        categoria: "Colaciones",
        nombre: "tallarines takiri",
        descripcion: "tallarines con pollo en salsa blanca y champiñones",
        precio: 4000,
        id: 115
    },
    {
        categoria: "Colaciones",
        nombre: "Cerdo o pollo agridulce",
        descripcion: "chuletas de cerdo salteado en salsa agridulce con arroz y ensalada",
        precio: 5000,
        id: 116
    },
    {
        categoria: "Colaciones",
        nombre: "pollo takiri",
        descripcion: "pollo salteado con champiñones , arroz y enselada fresca",
        precio: 4000,
        id: 117
    },
    {
        categoria: "Colaciones",
        nombre: "Ensalada fresca",
        descripcion: "Tomate, cebolla, lechuga, zanahoria, palta y su salsa de aderezo",
        precio: 3500,
        id: 118
    },
    {
        categoria: "Colaciones",
        nombre: "Pollo salteado con vegetales",
        descripcion: "Pollo con vegetales salteado y arroz",
        precio: 4000,
        id: 119
    },
    {
        categoria: "Colaciones",
        nombre: "tallarines salteados pollo",
        descripcion: "tallarines estilo chino, salteados con vegetales, especies chinas, pollo y soya",
        precio: 3500,
        id: 120
    },
    {
        categoria: "Colaciones",
        nombre: "Pescado en salsa de champiñones",
        descripcion: "Reineta a la plancha con salsa blanca de champiñones con arroz y ensalada chilena",
        precio: 500,
        id: 121
    },
    {
        categoria: "Colaciones",
        nombre: "Tallarines al estilo chino mixtos",
        descripcion: "Tallarines salteados con pollo y cerdo al estilo chino con vegetales y especias chinas",
        precio: 4000,
        id: 122
    },
    {
        categoria: "Colaciones",
        nombre: "arroz chino estilo venezolano pollo",
        descripcion: "arroz salteado con huevo diente de dragón , pollo ,zanahoria y cebollin aderezado con especias chinas salsa agridulce",
        precio: 5000,
        id: 123
    },
    {
        categoria: "Colaciones",
        nombre: "tallarines salteados cerdo",
        descripcion: "tallarines estilo chino, salteados con vegetales, especies chinas, cerdo y soya",
        precio: 0,
        id: 124
    },
    {
        categoria: "Colaciones",
        nombre: "Arroz chino al estilo Venezolano mix",
        descripcion: "Arroz frito con verduras y especies china de cerdo y pollo",
        precio: 0,
        id: 125
    },
    {
        categoria: "Colaciones",
        nombre: "pollo teriyaki",
        descripcion: "tiras de pollo en salsa teriyaki acompañado con arroz y vegetales salteados",
        precio: 4500,
        id: 126
    },
    {
        categoria: "Colaciones",
        nombre: "Tonkatsu de pollo",
        descripcion: "milanesa de pollo apanada con arroz , ensalda tonkatsu y miel mostaza",
        precio: 4500,
        id: 127
    },

    // Categoria: Gohan
    {
        categoria: "Gohan",
        nombre: "gohan vegetariano",
        descripcion: "base de arroz de sushi, queso crema, cebollón con vegetales",
        precio: 6000,
        id: 128
    },
    {
        categoria: "Gohan",
        nombre: "gohan de salmon camarones",
        descripcion: "base de arroz de sushi, queso crema y cebollón con salmon y camarones",
        precio: 7500,
        id: 129
    },
    {
        categoria: "Gohan",
        nombre: "gohan acevichado",
        descripcion: "base de arroz de sushi, queso crema, cebollón con ceviche de reineta",
        precio: 8000,
        id: 130
    },
    {
        categoria: "Gohan",
        nombre: "gohan de salmon",
        descripcion: "base de arroz de sushi, queso crema, cebollin con salmon",
        precio: 7000,
        id: 131
    },
    {
        categoria: "Gohan",
        nombre: "gohan de pollo",
        descripcion: "base de arroz de sushi, queso crema, cebollin y palta con pollo apanado",
        precio: 6000,
        id: 132
    },
    {
        categoria: "Gohan",
        nombre: "gohan de salmon y pollo",
        descripcion: "base de arroz de sushi, queso crema, cebollin con salmon y pollo apanado",
        precio: 7500,
        id: 133
    },
    {
        categoria: "Gohan",
        nombre: "gohan de camarones",
        descripcion: "base de arroz de sushi, queso crema, cebollin y palta con camarones",
        precio: 6500,
        id: 134
    },

    // Categoria: Platos calientes especiales
    {
        categoria: "Platos calientes especiales",
        nombre: "Tallarines salteados de mariscos",
        descripcion: "Tallarines salteados con verduras mixtas aderezados con especias chinas y surtido de mariscos",
        precio: 10000,
        id: 135
    },
    {
        categoria: "Platos calientes especiales",
        nombre: "tallarines a la huancaina de lomo",
        descripcion: "tallarón con salsa a la huancaína con lomo saltado",
        precio: 11500,
        id: 136
    },
    {
        categoria: "Platos calientes especiales",
        nombre: "tallarines a la huancaina de pollo o",
        descripcion: "tallarón con salsa a la huancaína con pollo salteado",
        precio: 9000,
        id: 137
    },
    {
        categoria: "Platos calientes especiales",
        nombre: "Verduras salteadas con camarones",
        descripcion: "Verduras salteadas con camarón",
        precio: 8000,
        id: 138
    },
    {
        categoria: "Platos calientes especiales",
        nombre: "Verduras salteadas de pollo",
        descripcion: "Verduras salteadas con una proteína a elección (pollo, cerdo.)",
        precio: 7000,
        id: 139
    },
    {
        categoria: "Platos calientes especiales",
        nombre: "tepanyaki pollo",
        descripcion: "Arroz frito estilo tailandés acompañado con cebolla y champiñones con pollo a la plancha con un toque de salsa agridulce y papas fritas o ensalada",
        precio: 8500,
        id: 140
    },
    {
        categoria: "Platos calientes especiales",
        nombre: "arroz chino especial",
        descripcion: "arroz frito con pollo, cerdo, camarones, huevo, diente de dragón, cebollón, salteado con especias chinas y soya mas un narrollado primavera hy salsa agiridulce",
        precio: 8500,
        id: 141
    },
    {
        categoria: "Platos calientes especiales",
        nombre: "salmon al grill",
        descripcion: "bañado con pebre y con un toque de salsa aji amarillo acompañado con arroz o papas",
        precio: 12500,
        id: 142
    },
    {
        categoria: "Platos calientes especiales",
        nombre: "lomo salteado",
        descripcion: "lomo salteado con vegetales estilo peruano acompañado de arroz y papas fritas",
        precio: 12500,
        id: 143
    },
    {
        categoria: "Platos calientes especiales",
        nombre: "Tallarines especiales",
        descripcion: "Tallarines salteados con mix de verduras y especias chinas con pollo, cerdo, y camarones",
        precio: 9000,
        id: 144
    },
    {
        categoria: "Platos calientes especiales",
        nombre: "arroz con mariscos",
        descripcion: "Arroz con mariscos aderezados con exqusita salsa de aji amarrillo coronado con ensalada criolla",
        precio: 12000,
        id: 145
    },
    {
        categoria: "Platos calientes especiales",
        nombre: "Tataki de atun",
        descripcion: "Atún sellado con pimienta y aceite de sésamo acompañado de arroz y verduras salteadas",
        precio: 10500,
        id: 146
    },
    {
        categoria: "Platos calientes especiales",
        nombre: "tallarin a la huancaina con mariscos",
        descripcion: "tallarón a la huancaina con mariscos salteados",
        precio: 11000,
        id: 147
    },
    {
        categoria: "Platos calientes especiales",
        nombre: "tepanyaki lomo",
        descripcion: "Arroz frito estilo tailandés acompañado con cebolla y champiñones con lomo a la plancha con un toque de salsa agridulce y papas fritas o ensalada",
        precio: 11000,
        id: 148
    },

    // Categoria: Ramen
    {
        categoria: "Ramen",
        nombre: "Ramen marino",
        descripcion: "Ramen de surtido de mariscos",
        precio: 7000,
        id: 149
    },
    {
        categoria: "Ramen",
        nombre: "Ramen de camarones",
        descripcion: "Ramen de camarones",
        precio: 6500,
        id: 150
    },
    {
        categoria: "Ramen",
        nombre: "Ramen de pollo",
        descripcion: "",
        precio: 6000,
        id: 151
    },
    {
        categoria: "Ramen",
        nombre: "Ramen de cerdo",
        descripcion: "",
        precio: 6000,
        id: 152
    },

    // Categoria: Bebidas y jugos
    {
        categoria: "Bebidas y jugos",
        nombre: "bebidas de la lata",
        descripcion: "",
        precio: 1500,
        id: 153
    },
    {
        categoria: "Bebidas y jugos",
        nombre: "limonada, menta gengibre",
        descripcion: "",
        precio: 2000,
        id: 154
    },
    {
        categoria: "Bebidas y jugos",
        nombre: "jugo natural piña",
        descripcion: "",
        precio: 2000,
        id: 155
    },
    {
        categoria: "Bebidas y jugos",
        nombre: "Agua sin gas de litros",
        descripcion: "",
        precio: 1500,
        id: 156
    },
    {
        categoria: "Bebidas y jugos",
        nombre: "Agua sin gas 700 gr",
        descripcion: "",
        precio: 1000,
        id: 157
    },
    {
        categoria: "Bebidas y jugos",
        nombre: "limonada",
        descripcion: "",
        precio: 1500,
        id: 158
    },
    {
        categoria: "Bebidas y jugos",
        nombre: "Jugo watts",
        descripcion: "De manzana o durazno",
        precio: 2500,
        id: 159
    },
    {
        categoria: "Bebidas y jugos",
        nombre: "Bebida grande",
        descripcion: "",
        precio: 2500,
        id: 160
    },
    {
        categoria: "Bebidas y jugos",
        nombre: "jugo natural maracuya",
        descripcion: "",
        precio: 2500,
        id: 161
    },
    {
        categoria: "Bebidas y jugos",
        nombre: "jugo natural de frutilla",
        descripcion: "",
        precio: 2500,
        id: 162
    },
    {
        categoria: "Bebidas y jugos",
        nombre: "Agua saborizada",
        descripcion: "Mango-maracuya, manzana",
        precio: 2000,
        id: 163
    },

    // Categoria: Promociones
    {
        categoria: "Promociones",
        nombre: "promo de 60 piezas",
        descripcion: "10 de piezas de pollo en sesamo o cibullete\n10 piezas de salmon en palta\n10 piezas de camaron en salmon\n10 piezas de champiñon en platano\n10 piezas de pollo en queso crema\n10 piezas de kanikama en panko",
        precio: 26500,
        id: 164
    },
    {
        categoria: "Promociones",
        nombre: "Promo 40 piezas",
        descripcion: "10 piezas de pollo en sésamo o ciboulette\n10 piezas de camarón en queso crema\n10 piezas de Salmon en palta\n10 piezas de kanikama en panko",
        precio: 16500,
        id: 165
    },
    {
        categoria: "Promociones",
        nombre: "Promo 30 piezas",
        descripcion: "10 piezas de pollo en sésamo o ciboulette\n10 piezas de camarón en palta\n10 piezas de kanikama en panko",
        precio: 12500,
        id: 166
    },
    {
        categoria: "Promociones",
        nombre: "Producto 13",
        descripcion: "",
        precio: 0,
        id: 167
    },
    {
        categoria: "Promociones",
        nombre: "Promoción de 50 piezas vegetariana",
        descripcion: "10 pieza de champiñon, queso crema, cebollin en sésamo o cibullet.\n10 pieza de palmito, queso crema cebollin en palta\n10 pieza de verduras tempura, queso crema, cebollin en panko.\n10 piezas de palta, pimentón, cebollin en queso crema.\n10 piezas de champiñon, queso crema, cebollin en plátano.",
        precio: 20000,
        id: 168
    },
    {
        categoria: "Promociones",
        nombre: "Promocion 40 piezas vegetariana",
        descripcion: "10 pieza de champiñon, queso crema, cebollin en sésamo o cibullet.\n10 pieza de palmito, queso crema cebollin en palta\n10 pieza de verduras tempura, queso crema, cebollin en panko.\n10 piezas de palta, pimentón, cebollin en queso crema.",
        precio: 15500,
        id: 169
    },
    {
        categoria: "Promociones",
        nombre: "Promoción de 30 piezas vegetariana",
        descripcion: "10 pieza de champiñon, queso crema, cebollin en sésamo o cibullet.\n10 pieza de palmito, queso crema cebollin en palta\n10 pieza de verduras tempura, queso crema, cebollin en panko.",
        precio: 11500,
        id: 170
    },
    {
        categoria: "Promociones",
        nombre: "Promocion 20 piezas vegetariana",
        descripcion: "10 pieza de champiñon,queso crema, cebollin en sésamo o cibullet.\n\n10 pieza de palmito, queso crema, cebollin en palta.",
        precio: 8500,
        id: 171
    },
    {
        categoria: "Promociones",
        nombre: "Promo de fútbol",
        descripcion: "60 piezas surtidas",
        precio: 21000,
        id: 172
    },
    {
        categoria: "Promociones",
        nombre: "Promo 3 hand roll",
        descripcion: "hand roll de pollo\nhand roll de kanikama\nhand roll de camarones",
        precio: 10500,
        id: 173
    },
    {
        categoria: "Promociones",
        nombre: "promo 20 piezas",
        descripcion: "10 piezas de pollo en sésamo o ciboulette\n10 piezas de camarón en panko",
        precio: 8500,
        id: 174
    },
    {
        categoria: "Promociones",
        nombre: "Promo 2 hand rolls",
        descripcion: "hand roll de pollo\nhand roll kanikama",
        precio: 7500,
        id: 175
    },
    {
        categoria: "Promociones",
        nombre: "promo 50 piezas",
        descripcion: "10 piezas de pollo en queso crema\n10 piezas de camarón en salmón\n10 piezas de salmón en palta\n10 piezas de kanikama en panko\n10 piezas de pollo en panko",
        precio: 22000,
        id: 176
    },
    {
        categoria: "Promociones",
        nombre: "Promoción especial hand roll",
        descripcion: "4 hand rolls de pollo queso crema y cebollón\nPromo especiales días feriados",
        precio: 10000,
        id: 177
    },
];

// Exportar los datos para que estén disponibles globalmente
window.allProductsData = allProductsData;

// Filtrar los productos que son de 'Delivery' si no se consideran productos de menú
const menuProductsData = allProductsData.filter(product => product.categoria !== 'Delivery' && product.precio > 0);

// Puedes exponer solo los productos de menú si prefieres
window.menuProductsData = menuProductsData;

// Nota: El CSV contiene algunos ítems con precio 0.00. Estos podrían ser variantes
// o simplemente entradas incompletas. Por ahora, los he incluido pero filtrados
// de menuProductsData si su precio es 0 para no mostrarlos como productos comprables.
// Los ítems de categoría 'Delivery' también se han excluido de menuProductsData.

// Puedes agregar más lógica aquí si necesitas categorizar productos por sucursal
// basándote en los datos del CSV, pero el CSV no parece indicar sucursales específicas
// para cada producto, excepto quizás en los ítems de Delivery.
// Por ahora, asumiremos que todos los productos en menuProductsData están disponibles
// en ambas sucursales, o que la lógica de filtrado por sucursal se maneja en otro lugar.

// Si hay productos específicos de sucursal en el CSV (más allá del Delivery),
// habría que ajustar la lógica de carga y filtrado aquí o en main.js.