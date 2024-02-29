<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //1
        Product::create([
            'name' => 'Portátil UltraSlim',
            'price' => 1350,
            'description' => "Diseño ultradelgado y potencia excepcional con su procesador de última generación.",
            'tax_id' => 1,
            'coupon_id' => 1,
            'color' => 'Plata Estelar',
            'stock' => 80,
            'specs' => 'Pantalla Full HD, Teclado retroiluminado',
            'features' => 'Movilidad extrema y rendimiento superior'
        ]);

        //2
        Product::create([
            'name' => 'PC Gamer Xtreme',
            'price' => 2500,
            'description' => "Diseñada para gamers, con tarjeta gráfica potente y gran capacidad de almacenamiento.",
            'tax_id' => 1,
            'coupon_id' => 1,
            'color' => 'Negro/Rojo',
            'stock' => 50,
            'specs' => 'Procesador de alta frecuencia, Tarjeta gráfica dedicada',
            'features' => 'Experiencia de juego inmersiva'
        ]);

        //3
        Product::create([
            'name' => 'Tarjeta Gráfica GeForce RTX 3080',
            'price' => 1200,
            'description' => "Potencia gráfica incomparable para juegos y aplicaciones de edición de video.",
            'tax_id' => 1,
            'coupon_id' => 1,
            'color' => 'Plateado/Negro',
            'stock' => 30,
            'specs' => 'Memoria GDDR6, Ray Tracing en tiempo real',
            'features' => 'Rendimiento gráfico de última generación'
        ]);

        //4
        Product::create([
            'name' => 'Teclado Mecánico RGB',
            'price' => 150,
            'description' => "Switches mecánicos para una experiencia de escritura rápida y precisa.",
            'tax_id' => 1,
            'coupon_id' => 1,
            'color' => 'Negro',
            'stock' => 120,
            'specs' => 'Switches mecánicos, Retroiluminación RGB',
            'features' => 'Comodidad y estilo para tus sesiones de juego o trabajo'
        ]);

        //5
        Product::create([
            'name' => 'Tarjeta Gráfica AMD Radeon RX 6700 XT',
            'price' => 850,
            'description' => "Disfruta de un rendimiento gráfico excepcional con la tarjeta gráfica AMD Radeon RX 6700 XT, diseñada para juegos de alta calidad y contenido multimedia.",
            'tax_id' => 1,
            'coupon_id' => 1,
            'color' => 'Rojo y Negro',
            'stock' => 15,
            'specs' => 'AMD Radeon RX 6700 XT, 12GB GDDR6, Arquitectura RDNA 2, Ray Tracing',
            'features' => 'Rendimiento gráfico avanzado y compatibilidad con tecnologías modernas'
        ]);

        //6
        Product::create([
            'name' => 'Monitor Curvo 4K',
            'price' => 800,
            'description' => "Imágenes nítidas y colores vibrantes con una pantalla curva de alta resolución.",
            'tax_id' => 1,
            'coupon_id' => 1,
            'color' => 'Negro',
            'stock' => 60,
            'specs' => 'Resolución 4K, Curvatura envolvente',
            'features' => 'Visualización inmersiva'
        ]);

        //7
        Product::create([
            'name' => 'Procesador Intel Core i9-11900K',
            'price' => 550,
            'description' => "Experimenta un rendimiento excepcional con el procesador Intel Core i9-11900K, diseñado para juegos y aplicaciones intensivas.",
            'tax_id' => 1,
            'coupon_id' => 1,
            'color' => 'Plata',
            'stock' => 15,
            'specs' => 'Arquitectura Rocket Lake, 8 núcleos y 16 hilos, Frecuencia base de 3.5GHz (hasta 5.3GHz con Turbo Boost)',
            'features' => 'Potencia de procesamiento superior para tareas exigentes'
        ]);

        //8
        Product::create([
            'name' => 'Placa Base ASUS ROG Strix B550-F Gaming',
            'price' => 200,
            'description' => "Construye tu sistema gaming con la placa base ASUS ROG Strix B550-F Gaming, equipada con características avanzadas y un diseño atractivo.",
            'tax_id' => 1,
            'coupon_id' => 1,
            'color' => 'Negro y Gris',
            'stock' => 20,
            'specs' => 'Socket AMD AM4, Chipset B550, DDR4 5100MHz (OC), PCIe 4.0, LAN Intel® 2.5Gb, Audio SupremeFX S1220A',
            'features' => 'Diseño gaming, Conectividad de alta velocidad y calidad de audio superior'
        ]);

        //9
        Product::create([
            'name' => 'Disipador de Calor Noctua NH-D15',
            'price' => 90,
            'description' => "Mantén la temperatura de tu CPU bajo control con el disipador de calor Noctua NH-D15, conocido por su rendimiento y bajo nivel de ruido.",
            'tax_id' => 1,
            'coupon_id' => 1,
            'color' => 'Beige y Marrón',
            'stock' => 25,
            'specs' => 'Doble torre, Ventiladores NF-A15 PWM, Diseño de baja sonoridad',
            'features' => 'Refrigeración eficiente y silenciosa para sistemas exigentes'
        ]);

        //10
        Product::create([
            'name' => 'Memoria RAM Corsair Vengeance LPX 16GB',
            'price' => 80,
            'description' => "Mejora el rendimiento de tu sistema con la memoria RAM Corsair Vengeance LPX de 16GB, ideal para juegos y tareas intensivas.",
            'tax_id' => 1,
            'coupon_id' => 1,
            'color' => 'Negro',
            'stock' => 30,
            'specs' => 'Capacidad 16GB (2x8GB), DDR4, Frecuencia 3200MHz, Perfil de overclocking XMP 2.0',
            'features' => 'Rendimiento fiable para multitarea y aplicaciones exigentes'
        ]);

        //11
        Product::create([
            'name' => 'Kit de Memoria RAM DDR4 16GB',
            'price' => 120,
            'description' => "Mejora el rendimiento de tu PC con este kit de memoria RAM de alta velocidad y capacidad.",
            'tax_id' => 1,
            'coupon_id' => 1,
            'color' => 'Plata',
            'stock' => 50,
            'specs' => 'DDR4, 3200MHz, 16GB (2x8GB)',
            'features' => 'Mejora la velocidad de tu sistema'
        ]);

        //12
        Product::create([
            'name' => 'Disco Duro SSD NVMe 1TB',
            'price' => 180,
            'description' => "Acelera el rendimiento de almacenamiento de tu PC con este disco duro SSD NVMe de alta capacidad.",
            'tax_id' => 1,
            'coupon_id' => 1,
            'color' => 'Negro',
            'stock' => 25,
            'specs' => 'Capacidad 1TB, Interfaz NVMe',
            'features' => 'Transferencias de datos ultrarrápidas'
        ]);

        //13
        Product::create([
            'name' => 'Disipador de Calor para CPU',
            'price' => 45,
            'description' => "Mantén tu procesador a una temperatura óptima con este disipador de calor eficiente y silencioso.",
            'tax_id' => 1,
            'coupon_id' => 1,
            'color' => 'Negro',
            'stock' => 35,
            'specs' => 'Compatibilidad con varios sockets, Ventilador silencioso',
            'features' => 'Refrigeración efectiva para tu CPU'
        ]);

        //14
        Product::create([
            'name' => 'Placa Base ATX con Wi-Fi 6',
            'price' => 220,
            'description' => "Construye la base de tu PC con esta tarjeta madre ATX que incluye Wi-Fi 6 para conectividad inalámbrica de alta velocidad.",
            'tax_id' => 1,
            'coupon_id' => 1,
            'color' => 'Negro y Blanco',
            'stock' => 20,
            'specs' => 'Formato ATX, Wi-Fi 6 integrado',
            'features' => 'Conectividad avanzada para tu sistema'
        ]);

        //15
        Product::create([
            'name' => 'Mouse Gaming RGB con Botones Programables',
            'price' => 60,
            'description' => "Optimiza tu experiencia de juego con este mouse gaming equipado con iluminación RGB y botones programables.",
            'tax_id' => 1,
            'coupon_id' => 1,
            'color' => 'Negro',
            'stock' => 40,
            'specs' => 'Sensor óptico de alta precisión, Iluminación RGB personalizable',
            'features' => 'Personalización y rendimiento para gamers'
        ]);

        //16
        Product::create([
            'name' => 'Fuente de Alimentación Modular 750W 80 Plus Gold',
            'price' => 130,
            'description' => "Asegura una alimentación eficiente y estable para tu PC con esta fuente de poder modular certificada 80 Plus Gold.",
            'tax_id' => 1,
            'coupon_id' => 1,
            'color' => 'Negro',
            'stock' => 30,
            'specs' => 'Capacidad 750W, Certificación 80 Plus Gold',
            'features' => 'Alimentación confiable y eficiente'
        ]);

        //17
        Product::create([
            'name' => 'Webcam Full HD con Micrófono Integrado',
            'price' => 40,
            'description' => "Mejora tus videollamadas con esta webcam Full HD que incluye un micrófono integrado para una comunicación clara.",
            'tax_id' => 1,
            'coupon_id' => 1,
            'color' => 'Negro',
            'stock' => 25,
            'specs' => 'Resolución Full HD, Micrófono incorporado',
            'features' => 'Videollamadas de alta calidad'
        ]);

        //18
        Product::create([
            'name' => 'Teclado Inalámbrico Compacto',
            'price' => 35,
            'description' => "Optimiza tu espacio de trabajo con este teclado inalámbrico compacto y silencioso.",
            'tax_id' => 1,
            'coupon_id' => 1,
            'color' => 'Blanco y Plateado',
            'stock' => 50,
            'specs' => 'Conectividad inalámbrica, Diseño compacto',
            'features' => 'Comodidad y eficiencia'
        ]);

        //19
        Product::create([
            'name' => 'Tarjeta Gráfica ASUS ROG Strix RTX 3080',
            'price' => 1200,
            'description' => "Experimenta un rendimiento gráfico excepcional con la tarjeta gráfica ASUS ROG Strix RTX 3080, diseñada para juegos de última generación y aplicaciones de edición.",
            'tax_id' => 1,
            'coupon_id' => 1,
            'color' => 'Negro y RGB',
            'stock' => 20,
            'specs' => 'NVIDIA GeForce RTX 3080, 10GB GDDR6X, Arquitectura Ampere, Iluminación RGB ASUS Aura Sync',
            'features' => 'Rendimiento gráfico de alta gama y efectos de iluminación personalizables'
        ]);

        //20
        Product::create([
            'name' => 'Disco SSD NVMe Samsung 970 EVO Plus 500GB',
            'price' => 110,
            'description' => "Aumenta la velocidad de tu sistema con el disco SSD NVMe Samsung 970 EVO Plus de 500GB, ideal para arranques rápidos y transferencias de datos eficientes.",
            'tax_id' => 1,
            'coupon_id' => 1,
            'color' => 'Negro',
            'stock' => 25,
            'specs' => 'Capacidad 500GB, Interfaz NVMe PCIe Gen3 x4, Velocidad de lectura hasta 3500MB/s, Velocidad de escritura hasta 3300MB/s',
            'features' => 'Rendimiento de almacenamiento rápido y confiable'
        ]);

        //21
        Product::create([
            'name' => 'PC de Escritorio Gamer',
            'price' => 1500,
            'description' => "Potente PC de escritorio diseñado para gaming, con procesador de alta gama y tarjeta gráfica dedicada.",
            'tax_id' => 1,
            'coupon_id' => 1,
            'color' => 'Negro/Rojo',
            'stock' => 10,
            'specs' => 'Procesador Intel Core i7, Tarjeta gráfica NVIDIA GeForce RTX 3070, 16GB RAM, 1TB SSD',
            'features' => 'Rendimiento extremo para juegos exigentes'
        ]);

        //22
        Product::create([
            'name' => 'Portátil Ultrabook 13"',
            'price' => 1200,
            'description' => "Ligero y elegante portátil Ultrabook con pantalla de 13 pulgadas, ideal para la movilidad y la productividad.",
            'tax_id' => 1,
            'coupon_id' => 1,
            'color' => 'Plata',
            'stock' => 15,
            'specs' => 'Procesador Intel Core i5, 8GB RAM, 512GB SSD, Pantalla Full HD',
            'features' => 'Diseño delgado y rendimiento eficiente'
        ]);
    }
}
