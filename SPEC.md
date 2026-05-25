# SPEC.md - Tema WordPress "OnePage Minimal"

## 1. Concept & Vision

Tema de WordPress de una sola página diseñado para profesionales y pequeñas empresas. Minimalista, limpio y rápido. Ideal para landing pages, portafolios o sitios informativos simples. El personalizador permite cambiar colores y textos principales sin tocar código.

## 2. Design Language

### Aesthetic Direction
Minimalismo moderno con tipografía clara y espacios generosos. Referencias: temas de Squarespace y Ghost.

### Color Palette (Personalizable)
- **Primary:** #2563eb (Azul)
- **Secondary:** #1e40af (Azul oscuro)
- **Accent:** #f59e0b (Ámbar)
- **Background:** #ffffff
- **Text:** #1f2937
- **Text Light:** #6b7280

### Typography
- **Headings:** Inter, system-ui, sans-serif
- **Body:** Inter, system-ui, sans-serif
- **Fallback:** -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto

### Spatial System
- Base unit: 8px
- Container max-width: 1200px
- Section padding: 80px vertical
- Component gap: 24px

### Motion Philosophy
- Transiciones suaves de 300ms
- Hover states con elevación sutil

## 3. Layout & Structure

### Files Structure
```
onepage-theme/
├── style.css          (Metadatos + estilos principales)
├── functions.php      (Enqueue scripts/estilos + Customizer)
├── index.php          (Loop principal)
├── header.php         (Header + wp_head)
├── footer.php         (Footer + wp_footer)
├── front-page.php     (Página frontal personalizada)
├── screenshot.png     (Captura del tema)
└── assets/
    ├── css/
    │   └── custom.css
    └── js/
        └── main.js
```

### Sections
1. Header con navegación
2. Hero section
3. Sección de características/servicios
4. Sección "Sobre nosotros"
5. Sección de contacto
6. Footer

## 4. Features & Interactions

### Customizer Options
- Título del sitio
- Color primario
- Color secundario
- Texto del hero
- Subtítulo del hero
- Información de contacto (email, teléfono)
- Redes sociales

### WordPress Features
- Soporte para título del sitio (title-tag)
- Soporte para logo personalizado
- Soporte para menús de navegación
- Soporte para widgets del footer
- Custom Logo
- Editor clásico (para contenido)

### Interactions
- Navegación smooth scroll
- Botones con hover effect
- Cards con elevación

## 5. Component Inventory

### Navigation
- Logo + nombre del sitio
- Enlaces a secciones (anchor links)
- Botón CTA

### Hero Section
- Título principal (customizer)
- Subtítulo (customizer)
- Botón de acción

### Feature Cards
- Ícono
- Título
- Descripción

### Contact Section
- Información de contacto
- Formulario (opcional)

### Footer
- Copyright
- Enlaces sociales
- Créditos

## 6. Technical Approach

### WordPress Version
- Compatible con WordPress 5.0+
- No requiere plugins externos

### Hooks Used
- wp_enqueue_scripts
- add_theme_support
- register_nav_menus
- customize_register

### Security
- escape() en todas las salidas
- sanitize_text_field() en entradas
- nonces para formularios

### Elementor Compatibility
- Full support for Elementor Page Builder
- `elementor-global` theme support
- `elementor-content-width` set to 1200px
- Body classes for Elementor
- Custom fonts (Inter) for Elementor
- Elementor-specific CSS styles
- Dedicated template: `template-elementor.php`

### Custom Templates
- `template-elementor.php` - Página completa para Elementor
- `template-pagebuilder.php` - Page Builder genérico