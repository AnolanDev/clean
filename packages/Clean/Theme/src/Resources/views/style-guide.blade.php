<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $config['name'] }} - Style Guide</title>
    <link href="{{ route('theme.api.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: {{ $config['fonts']['primary'] }};
            line-height: 1.6;
            color: #2d3748;
            background-color: #f8fafc;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .header {
            background: linear-gradient(135deg, {{ $config['colors']['primary'] }} 0%, {{ $config['colors']['secondary'] }} 100%);
            color: white;
            padding: 2rem 0;
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .section {
            background: white;
            margin: 2rem 0;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .section h2 {
            color: {{ $config['colors']['primary'] }};
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
        }
        
        .color-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin: 1rem 0;
        }
        
        .color-card {
            text-align: center;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }
        
        .color-swatch {
            height: 80px;
            width: 100%;
        }
        
        .color-info {
            padding: 1rem;
        }
        
        .color-name {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        
        .color-value {
            font-family: {{ $config['fonts']['monospace'] }};
            font-size: 0.9rem;
            color: #718096;
        }
        
        .component-demo {
            margin: 1rem 0;
            padding: 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background: #f7fafc;
        }
        
        .icon-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 1rem;
            margin: 1rem 0;
        }
        
        .icon-card {
            text-align: center;
            padding: 1rem;
            background: #f7fafc;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }
        
        .icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        
        .icon-name {
            font-size: 0.8rem;
            color: #718096;
        }
        
        .utility-demo {
            display: inline-block;
            margin: 0.5rem;
            padding: 0.5rem 1rem;
            background: {{ $config['colors']['light'] }};
            border: 1px solid #e2e8f0;
            border-radius: 5px;
        }
        
        .breakpoint-list {
            list-style: none;
            padding: 0;
        }
        
        .breakpoint-item {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .code {
            background: #f7fafc;
            padding: 1rem;
            border-radius: 5px;
            border: 1px solid #e2e8f0;
            font-family: {{ $config['fonts']['monospace'] }};
            font-size: 0.9rem;
            overflow-x: auto;
        }
        
        .feature-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            margin: 0.25rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .feature-badge.eco { background: #f0fff4; color: #22543d; }
        .feature-badge.safe { background: #e6fffa; color: #234e52; }
        .feature-badge.warning { background: #fffbeb; color: #744210; }
        .feature-badge.danger { background: #fed7d7; color: #742a2a; }
        
        .product-card-demo {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.2s ease;
            max-width: 300px;
        }
        
        .product-card-demo:hover {
            transform: translateY(-5px);
        }
        
        .product-image-demo {
            height: 150px;
            background: linear-gradient(45deg, #f7fafc, #edf2f7);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        
        .navigation {
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            border-radius: 10px;
            padding: 1rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 1000;
        }
        
        .navigation ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .navigation li {
            margin: 0.5rem 0;
        }
        
        .navigation a {
            color: {{ $config['colors']['primary'] }};
            text-decoration: none;
            font-size: 0.9rem;
        }
        
        .navigation a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="navigation">
        <ul>
            <li><a href="#colors">Colores</a></li>
            <li><a href="#typography">Tipografía</a></li>
            <li><a href="#components">Componentes</a></li>
            <li><a href="#icons">Iconos</a></li>
            <li><a href="#utilities">Utilidades</a></li>
            <li><a href="#breakpoints">Breakpoints</a></li>
        </ul>
    </div>

    <div class="header">
        <div class="container">
            <h1>{{ $config['name'] }}</h1>
            <p>{{ $config['description'] }}</p>
            <p>Versión {{ $config['version'] }} • Por {{ $config['author'] }}</p>
        </div>
    </div>

    <div class="container">
        <section id="colors" class="section">
            <h2>🎨 Paleta de Colores</h2>
            <div class="color-grid">
                @foreach($config['colors'] as $name => $color)
                    <div class="color-card">
                        <div class="color-swatch" style="background-color: {{ $color }};"></div>
                        <div class="color-info">
                            <div class="color-name">{{ ucfirst($name) }}</div>
                            <div class="color-value">{{ $color }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <section id="typography" class="section">
            <h2>📝 Tipografía</h2>
            <div class="component-demo">
                <h1 style="font-family: {{ $config['fonts']['primary'] }}; margin-bottom: 1rem;">
                    Heading 1 - {{ $config['fonts']['primary'] }}
                </h1>
                <h2 style="font-family: {{ $config['fonts']['secondary'] }}; margin-bottom: 1rem;">
                    Heading 2 - {{ $config['fonts']['secondary'] }}
                </h2>
                <p style="font-family: {{ $config['fonts']['primary'] }}; margin-bottom: 1rem;">
                    Párrafo con fuente principal. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                </p>
                <code style="font-family: {{ $config['fonts']['monospace'] }}; background: #f7fafc; padding: 0.25rem 0.5rem; border-radius: 3px;">
                    Código con fuente monoespaciada
                </code>
            </div>
        </section>

        <section id="components" class="section">
            <h2>🧩 Componentes</h2>
            
            <h3>Tarjeta de Producto</h3>
            <div class="component-demo">
                <div class="product-card-demo">
                    <div class="product-image-demo">🧴</div>
                    <h4>Desengrasante Ecológico</h4>
                    <p style="color: {{ $config['colors']['primary'] }}; margin-bottom: 1rem;">EcoClean</p>
                    <div>
                        <span class="feature-badge eco">🌿 Ecológico</span>
                        <span class="feature-badge safe">🛡️ Seguro</span>
                    </div>
                </div>
            </div>

            <h3>Badges de Características</h3>
            <div class="component-demo">
                <span class="feature-badge eco">🌿 Ecológico</span>
                <span class="feature-badge safe">🛡️ Seguro</span>
                <span class="feature-badge warning">⚠️ Precaución</span>
                <span class="feature-badge danger">🚨 Peligroso</span>
            </div>

            <h3>Botones</h3>
            <div class="component-demo">
                <button style="background: {{ $config['colors']['primary'] }}; color: white; padding: 0.5rem 1rem; border: none; border-radius: 5px; margin-right: 0.5rem; cursor: pointer;">
                    Botón Primario
                </button>
                <button style="background: {{ $config['colors']['secondary'] }}; color: white; padding: 0.5rem 1rem; border: none; border-radius: 5px; margin-right: 0.5rem; cursor: pointer;">
                    Botón Secundario
                </button>
                <button style="background: {{ $config['colors']['success'] }}; color: white; padding: 0.5rem 1rem; border: none; border-radius: 5px; margin-right: 0.5rem; cursor: pointer;">
                    Éxito
                </button>
                <button style="background: {{ $config['colors']['danger'] }}; color: white; padding: 0.5rem 1rem; border: none; border-radius: 5px; cursor: pointer;">
                    Peligro
                </button>
            </div>
        </section>

        <section id="icons" class="section">
            <h2>🔤 Iconos</h2>
            
            <h3>Tipos de Producto</h3>
            <div class="icon-grid">
                @foreach($icons['product-types'] as $type => $icon)
                    <div class="icon-card">
                        <div class="icon">{{ $icon }}</div>
                        <div class="icon-name">{{ $type }}</div>
                    </div>
                @endforeach
            </div>

            <h3>Categorías</h3>
            <div class="icon-grid">
                @foreach($icons['categories'] as $category => $icon)
                    <div class="icon-card">
                        <div class="icon">{{ $icon }}</div>
                        <div class="icon-name">{{ $category }}</div>
                    </div>
                @endforeach
            </div>

            <h3>Características</h3>
            <div class="icon-grid">
                @foreach($icons['features'] as $feature => $icon)
                    <div class="icon-card">
                        <div class="icon">{{ $icon }}</div>
                        <div class="icon-name">{{ $feature }}</div>
                    </div>
                @endforeach
            </div>
        </section>

        <section id="utilities" class="section">
            <h2>🛠️ Utilidades</h2>
            
            <h3>Espaciado</h3>
            <div class="component-demo">
                @foreach($utilities['spacing'] as $name => $value)
                    <div class="utility-demo">
                        <strong>{{ $name }}</strong>: {{ $value }}
                    </div>
                @endforeach
            </div>

            <h3>Sombras</h3>
            <div class="component-demo">
                @foreach($utilities['shadows'] as $name => $value)
                    <div class="utility-demo" style="box-shadow: {{ $value }};">
                        shadow-{{ $name }}
                    </div>
                @endforeach
            </div>

            <h3>Border Radius</h3>
            <div class="component-demo">
                @foreach($utilities['border-radius'] as $name => $value)
                    <div class="utility-demo" style="border-radius: {{ $value }};">
                        rounded-{{ $name }}
                    </div>
                @endforeach
            </div>
        </section>

        <section id="breakpoints" class="section">
            <h2>📱 Breakpoints Responsivos</h2>
            <ul class="breakpoint-list">
                @foreach($breakpoints as $name => $value)
                    <li class="breakpoint-item">
                        <strong>{{ $name }}</strong>
                        <span>{{ $value }}</span>
                    </li>
                @endforeach
            </ul>
        </section>

        <section class="section">
            <h2>💻 Uso del CSS</h2>
            <p>Para usar este tema en tu aplicación, incluye el CSS generado:</p>
            <div class="code">
&lt;link href="{{ route('theme.api.css') }}" rel="stylesheet"&gt;
            </div>
            
            <p>O obtén la configuración como JSON:</p>
            <div class="code">
fetch('{{ route('theme.api.config') }}')
  .then(response => response.json())
  .then(config => {
    // Usar configuración del tema
    console.log(config);
  });
            </div>
        </section>
    </div>
</body>
</html>