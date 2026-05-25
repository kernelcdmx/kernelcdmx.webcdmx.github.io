# OnePage Minimal - WordPress Theme

Un tema de WordPress de una sola página, minimalista y moderno. Perfecto para landing pages, portafolios y sitios informativos.

## Requisitos

- WordPress 5.0 o superior
- PHP 7.4 o superior

## Instalación

### Método 1: Panel de WordPress

1. Descarga el archivo ZIP del tema
2. Ve a **Apariencia > Temas > Añadir nuevo**
3. Clic en **Subir tema**
4. Selecciona el archivo ZIP
5. Clic en **Instalar ahora**
6. Activa el tema

### Método 2: FTP / File Manager

1. Descomprime el archivo ZIP
2. Sube la carpeta `onepage-theme` a `/wp-content/themes/`
3. Ve a **Apariencia > Temas**
4. Activa el tema

## Estructura de Archivos

```
onepage-theme/
├── assets/
│   ├── css/
│   │   └── custom.css          # Estilos personalizados
│   └── js/
│       └── main.js             # JavaScript principal
├── style.css                   # Metadatos y estilos base
├── functions.php               # Funciones y configuración
├── index.php                   # Template principal
├── header.php                  # Cabecera del sitio
├── footer.php                  # Pie de página
├── front-page.php              # Página frontal
├── SPEC.md                     # Especificaciones del tema
└── README.md                   # Este archivo
```

## Configuración

### 1. Personalizador de WordPress

Ve a **Apariencia > Personalizar** para configurar:

#### Configuración General
- **Título del Hero**: Título principal de la sección hero
- **Subtítulo del Hero**: Descripción bajo el título

#### Colores
- **Color Primario**: Color principal del sitio (botones, enlaces, acentos)
- **Color Secundario**: Color secundario para hover states

#### Información de Contacto
- **Correo Electrónico**: Email de contacto
- **Teléfono**: Número de contacto
- **Dirección**: Dirección física

#### Redes Sociales
- **Facebook**: URL de Facebook
- **Twitter/X**: URL de Twitter
- **Instagram**: URL de Instagram
- **LinkedIn**: URL de LinkedIn

#### Estadísticas
- **Proyectos completados**
- **Clientes satisfechos**
- **Años de experiencia**

### 2. Logo Personalizado

Ve a **Apariencia > Personalizar > Identidad del sitio** para subir tu logo.

### 3. Menú de Navegación

Ve a **Apariencia > Menús** para crear y asignar el menú de navegación.

1. Crea un nuevo menú
2. Añade enlaces con anclas (#features, #about, #contact)
3. Asigna el menú a la ubicación "Primary Menu"

## Hooks y Filtros

### Acciones Personalizadas

```php
// Agregar código antes del </head>
add_action('wp_head', 'tu_funcion_personalizada');

// Agregar código antes del </body>
add_action('wp_footer', 'tu_funcion_personalizada');
```

### Filtros Personalizados

```php
// Modificar longitud del excerpt
add_filter('excerpt_length', 'tu_funcion_excerpt_length');

// Modificar "Leer más" del excerpt
add_filter('excerpt_more', 'tu_funcion_excerpt_more');
```

## AJAX Contact Form

El formulario de contacto usa AJAX para enviar mensajes sin recargar la página.

### Personalizar el Destinatario

```php
// En functions.php o un plugin mu
add_filter('wp_mail', function($args) {
    $args['to'] = 'nuevo-email@ejemplo.com';
    return $args;
});
```

## Soporte

Para soporte, reportar bugs o contribuir:
- Crea un issue en GitHub
- Contacto: tu-email@ejemplo.com

---

## 🎨 Compatibilidad con Elementor

Este tema está diseñado para ser totalmente compatible con Elementor Page Builder.

### Requisitos

- **Elementor** versión 3.0 o superior (gratuito o Pro)
- **PHP** 7.4 o superior
- **Memory Limit** mínimo 256MB (recomendado 512MB)

### Solución de Problemas

Si Elementor no carga correctamente, prueba estas soluciones:

#### 1. Verificar configuración del hosting
Ve a **Herramientas > Salud del sitio > Info > Servidor** y verifica:
- PHP Version: 7.4 o superior
- Memory Limit: 256MB o más
- max_execution_time: 300 o más

#### 2. Aumentar memoria PHP
Agrega esto en tu `wp-config.php`:
```php
define('WP_MEMORY_LIMIT', '512M');
define('WP_MAX_MEMORY_LIMIT', '512M');
```

#### 3. Regenerar archivos de Elementor
Ve a **Elementor > Herramientas > Regenerar Datos** y limpia la caché.

#### 4. Activar "Switch Editor Loader"
Ve a **Elementor > Configuración > Avanzado** y activa "Switch Editor Loader Method".

#### 5. Verificar conflictos de plugins
Desactiva todos los plugins excepto Elementor y prueba editar.

#### 6. Verificar conflictos de temas
Cambia temporalmente a un tema por defecto (Twenty Twenty-Four) y prueba Elementor.

### Configuración del tema para Elementor

El tema ya incluye:
- Soporte completo para `the_content()`
- Estilos CSS para el editor
- Clases de body para Elementor
- Fonts personalizadas (Inter)
- Memoria aumentada automáticamente

### Recursos adicionales

- [Documentación oficial de Elementor](https://elementor.com/help/)
- [Requisitos del sistema](https://elementor.com/help/technical-requirements/)
- [Foro de soporte de Elementor](https://elementor.com/forums/)

## Licencia

GNU General Public License v2 or later
http://www.gnu.org/licenses/gpl-2.0.html

## Créditos

- Normalize.css - https://necolas.github.io/normalize.css/
- Google Fonts (Inter) - https://fonts.google.com/specimen/Inter
- Dashicons (WordPress) - https://developer.wordpress.org/resource/dashicons/

---

Creado con ❤️ para la comunidad de WordPress