import { useEffect, useRef, useState } from 'react';
import { Bed, Bath, Car, Ruler, MapPin, Home, CheckCircle2, Phone, Menu, X } from 'lucide-react';

// Logo component (used in header)
function useIntersectionObserver(options = {}) {
  const ref = useRef<HTMLDivElement>(null);
  const [isVisible, setIsVisible] = useState(false);

  useEffect(() => {
    const observer = new IntersectionObserver(([entry]) => {
      if (entry.isIntersecting) {
        setIsVisible(true);
        observer.disconnect();
      }
    }, { threshold: 0.1, ...options });

    if (ref.current) {
      observer.observe(ref.current);
    }

    return () => observer.disconnect();
  }, []);

  return { ref, isVisible };
}

// Animated section component
function AnimatedSection({ children, className = '', delay = 0 }: { children: React.ReactNode; className?: string; delay?: number }) {
  const { ref, isVisible } = useIntersectionObserver();
  
  return (
    <div
      ref={ref}
      className={`transition-all duration-700 ease-out ${className}`}
      style={{
        opacity: isVisible ? 1 : 0,
        transform: isVisible ? 'translateY(0)' : 'translateY(30px)',
        transitionDelay: `${delay}ms`
      }}
    >
      {children}
    </div>
  );
}

// Stats badge component
function StatBadge({ icon: Icon, value, label }: { icon: React.ElementType; value: string; label: string }) {
  return (
    <div className="bg-white rounded-2xl shadow-lg shadow-emerald-900/10 p-4 flex flex-col items-center min-w-[120px] md:min-w-[140px] hover:shadow-xl hover:scale-105 transition-all duration-300">
      <Icon className="w-6 h-6 text-emerald-800 mb-2" strokeWidth={1.5} />
      <span className="text-2xl font-bold text-emerald-900" style={{ fontFamily: 'Playfair Display, serif' }}>
        {value}
      </span>
      <span className="text-sm text-gray-600 font-medium">{label}</span>
    </div>
  );
}

// Feature card component
function FeatureCard({ icon: Icon, title, subtitle }: { icon: React.ElementType; title: string; subtitle: string }) {
  return (
    <div className="bg-white rounded-xl p-6 shadow-md shadow-emerald-900/5 hover:shadow-lg hover:scale-102 transition-all duration-300 border border-gray-100">
      <div className="w-12 h-12 bg-emerald-50 rounded-full flex items-center justify-center mb-4">
        <Icon className="w-6 h-6 text-emerald-800" strokeWidth={1.5} />
      </div>
      <h3 className="text-lg font-semibold text-gray-900 mb-1">{title}</h3>
      <p className="text-sm text-gray-500">{subtitle}</p>
    </div>
  );
}

// WhatsApp button component
function WhatsAppButton({ large = false }: { large?: boolean }) {
  return (
    <a
      href="https://wa.me/5214521539683?text=Hola%2C%20me%20interesa%20la%20casa%20en%20venta%20en%20El%20Mirador%2C%20Uruapan."
      target="_blank"
      rel="noopener noreferrer"
      className={`
        inline-flex items-center justify-center gap-3 bg-[#25D366] hover:bg-[#20BD5A] text-white font-semibold rounded-full
        shadow-lg shadow-green-500/30 hover:shadow-xl hover:shadow-green-500/40 hover:scale-105 transition-all duration-300
        ${large ? 'px-10 py-5 text-lg' : 'px-8 py-4 text-base'}
      `}
    >
      <svg viewBox="0 0 24 24" className="w-6 h-6 fill-current">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
      </svg>
      WhatsApp
    </a>
  );
}

// Mobile menu component
function MobileMenu({ isOpen, onClose }: { isOpen: boolean; onClose: () => void }) {
  if (!isOpen) return null;
  
  return (
    <div className="fixed inset-0 bg-emerald-900/95 z-50 flex items-center justify-center p-8 md:hidden">
      <button 
        onClick={onClose}
        className="absolute top-6 right-6 text-white"
        aria-label="Cerrar menú"
      >
        <X className="w-8 h-8" />
      </button>
      <nav className="flex flex-col items-center gap-8 text-center">
        <a href="#inicio" onClick={onClose} className="text-white text-2xl font-medium hover:text-emerald-300 transition-colors">
          Inicio
        </a>
        <a href="#recorrido" onClick={onClose} className="text-white text-2xl font-medium hover:text-emerald-300 transition-colors">
          Recorrido
        </a>
        <a href="#distribucion" onClick={onClose} className="text-white text-2xl font-medium hover:text-emerald-300 transition-colors">
          Distribución
        </a>
        <a href="#ubicacion" onClick={onClose} className="text-white text-2xl font-medium hover:text-emerald-300 transition-colors">
          Ubicación
        </a>
        <WhatsAppButton large />
      </nav>
    </div>
  );
}

// Header component
function Header() {
  const [menuOpen, setMenuOpen] = useState(false);
  const [scrolled, setScrolled] = useState(false);

  useEffect(() => {
    const handleScroll = () => {
      setScrolled(window.scrollY > 50);
    };
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  return (
    <>
      <header 
        className={`fixed top-0 left-0 right-0 z-40 transition-all duration-300 ${
          scrolled ? 'bg-white shadow-md py-2' : 'bg-transparent py-4'
        }`}
      >
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex items-center justify-between">
            {/* Logo */}
            <div className={`flex items-center gap-3 transition-all duration-300 ${scrolled ? 'scale-90' : ''}`}>
              <div className="w-10 h-10 bg-gradient-to-br from-emerald-800 to-emerald-700 rounded-lg flex items-center justify-center shadow-md">
                <Home className="w-5 h-5 text-white" />
              </div>
              <div className="flex flex-col">
                <span className="text-lg font-bold text-emerald-900" style={{ fontFamily: 'Playfair Display, serif' }}>
                  ACI
                </span>
                <span className="text-[10px] text-emerald-700 font-medium tracking-wide hidden sm:block">
                  GRUPO INMOBILIARIO
                </span>
              </div>
            </div>

            {/* Desktop Navigation */}
            <nav className="hidden md:flex items-center gap-8">
              <a href="#inicio" className="text-emerald-900 hover:text-emerald-700 font-medium transition-colors">
                Inicio
              </a>
              <a href="#recorrido" className="text-emerald-900 hover:text-emerald-700 font-medium transition-colors">
                Recorrido
              </a>
              <a href="#distribucion" className="text-emerald-900 hover:text-emerald-700 font-medium transition-colors">
                Distribución
              </a>
              <a href="#ubicacion" className="text-emerald-900 hover:text-emerald-700 font-medium transition-colors">
                Ubicación
              </a>
              <WhatsAppButton />
            </nav>

            {/* Mobile Menu Button */}
            <button 
              onClick={() => setMenuOpen(true)}
              className="md:hidden text-emerald-900 p-2"
              aria-label="Abrir menú"
            >
              <Menu className="w-7 h-7" />
            </button>
          </div>
        </div>
      </header>
      
      <MobileMenu isOpen={menuOpen} onClose={() => setMenuOpen(false)} />
    </>
  );
}

// Hero section
function HeroSection() {
  return (
    <section id="inicio" className="relative min-h-screen bg-gradient-to-b from-emerald-50 via-white to-white pt-24 pb-16">
      {/* Decorative elements */}
      <div className="absolute top-40 left-8 w-64 h-64 bg-emerald-200/30 rounded-full blur-3xl" />
      <div className="absolute bottom-40 right-8 w-96 h-96 bg-emerald-100/40 rounded-full blur-3xl" />
      
      <div className="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Badge */}
        <AnimatedSection className="flex justify-center mb-8">
          <span className="inline-flex items-center gap-2 bg-emerald-900 text-white px-6 py-2 rounded-full text-sm font-medium shadow-lg shadow-emerald-900/20">
            <span className="w-2 h-2 bg-emerald-400 rounded-full animate-pulse" />
            Nueva propiedad disponible
          </span>
        </AnimatedSection>

        {/* Main content */}
        <div className="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
          {/* Left content */}
          <AnimatedSection delay={100}>
            <div className="space-y-8">
              <h1 
                className="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight"
                style={{ fontFamily: 'Playfair Display, serif' }}
              >
                Descubre esta{' '}
                <span className="text-emerald-800">hermosa propiedad</span>
              </h1>
              <p className="text-lg text-gray-600 leading-relaxed max-w-xl">
                Con amplios espacios y excelente distribución, ideal para vivir con comodidad y estilo.
              </p>

              {/* Stats grid */}
              <div className="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <StatBadge icon={Bed} value="3" label="Recámaras" />
                <StatBadge icon={Bath} value="3.5" label="Baños" />
                <StatBadge icon={Car} value="2" label="Autos" />
                <StatBadge icon={Ruler} value="10×20m" label="Terreno" />
              </div>

              {/* Price section */}
              <div className="bg-white rounded-2xl p-6 shadow-xl shadow-emerald-900/10 border border-emerald-100">
                <div className="flex flex-wrap items-center gap-6">
                  <div>
                    <span className="text-sm text-gray-500 font-medium">Precio</span>
                    <p className="text-4xl sm:text-5xl font-bold text-emerald-900" style={{ fontFamily: 'Playfair Display, serif' }}>
                      $7,200,000
                    </p>
                  </div>
                  <div className="h-12 w-px bg-gray-200 hidden sm:block" />
                  <div className="flex items-center gap-2">
                    <CheckCircle2 className="w-5 h-5 text-amber-500" />
                    <span className="text-sm font-semibold text-amber-700 bg-amber-50 px-3 py-1 rounded-full">
                      Plusvalía garantizada
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </AnimatedSection>

          {/* Right content - Image */}
          <AnimatedSection delay={200}>
            <div className="relative">
              {/* Main image */}
              <div className="relative rounded-3xl overflow-hidden shadow-2xl shadow-emerald-900/20">
                <img
                  src="https://images.pexels.com/photos/7031581/pexels-photo-7031581.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=800&w=1200"
                  alt="Fachada principal de la casa moderna en El Mirador, Uruapan"
                  className="w-full h-[400px] sm:h-[500px] object-cover"
                />
                <div className="absolute inset-0 bg-gradient-to-t from-emerald-900/20 to-transparent" />
              </div>
              
              {/* Floating badge */}
              <div className="absolute -bottom-6 -left-6 bg-white rounded-2xl p-4 shadow-xl shadow-emerald-900/15">
                <div className="flex items-center gap-3">
                  <div className="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center">
                    <MapPin className="w-6 h-6 text-emerald-800" />
                  </div>
                  <div>
                    <p className="text-xs text-gray-500 font-medium">Ubicación</p>
                    <p className="text-sm font-semibold text-gray-900">El Mirador, Uruapan</p>
                  </div>
                </div>
              </div>

              {/* Decorative frame */}
              <div className="absolute -top-4 -right-4 w-full h-full border-2 border-emerald-200 rounded-3xl -z-10" />
            </div>
          </AnimatedSection>
        </div>
      </div>
    </section>
  );
}

// Tour section
function TourSection() {
  return (
    <section id="recorrido" className="py-20 sm:py-28 bg-gradient-to-b from-emerald-900 via-emerald-800 to-emerald-900 text-white relative overflow-hidden">
      {/* Decorative elements */}
      <div className="absolute inset-0 opacity-10">
        <div className="absolute top-0 left-1/4 w-96 h-96 bg-white rounded-full blur-3xl" />
        <div className="absolute bottom-0 right-1/4 w-64 h-64 bg-emerald-300 rounded-full blur-3xl" />
      </div>

      <div className="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <AnimatedSection>
          <h2 
            className="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6"
            style={{ fontFamily: 'Playfair Display, serif' }}
          >
            Recorre la propiedad
          </h2>
          <p className="text-xl text-emerald-100 max-w-2xl mx-auto">
            Cada espacio diseñado para ofrecerte confort y elegancia
          </p>
        </AnimatedSection>

        {/* Gallery grid */}
        <AnimatedSection delay={100} className="mt-16">
          <div className="grid md:grid-cols-3 gap-6">
            <div className="relative rounded-2xl overflow-hidden group">
              <img
                src="https://images.pexels.com/photos/7167073/pexels-photo-7167073.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=600&w=800"
                alt="Sala y comedor moderno"
                className="w-full h-72 object-cover group-hover:scale-105 transition-transform duration-500"
              />
              <div className="absolute inset-0 bg-gradient-to-t from-emerald-900/70 to-transparent" />
              <div className="absolute bottom-4 left-4">
                <p className="text-white font-semibold">Sala y Comedor</p>
              </div>
            </div>
            <div className="relative rounded-2xl overflow-hidden group md:mt-12">
              <img
                src="https://images.pexels.com/photos/6265836/pexels-photo-6265836.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=600&w=800"
                alt="Cocina integral moderna"
                className="w-full h-72 object-cover group-hover:scale-105 transition-transform duration-500"
              />
              <div className="absolute inset-0 bg-gradient-to-t from-emerald-900/70 to-transparent" />
              <div className="absolute bottom-4 left-4">
                <p className="text-white font-semibold">Cocina Integral</p>
              </div>
            </div>
            <div className="relative rounded-2xl overflow-hidden group">
              <img
                src="https://images.pexels.com/photos/6585599/pexels-photo-6585599.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=600&w=800"
                alt="Área de descanso"
                className="w-full h-72 object-cover group-hover:scale-105 transition-transform duration-500"
              />
              <div className="absolute inset-0 bg-gradient-to-t from-emerald-900/70 to-transparent" />
              <div className="absolute bottom-4 left-4">
                <p className="text-white font-semibold">Recámara Principal</p>
              </div>
            </div>
          </div>
        </AnimatedSection>
      </div>
    </section>
  );
}

// Distribution section
function DistributionSection() {
  const spacesLeft = [
    'Sala y comedor',
    'Cocina integral',
    'Área de servicio',
    'Estudio independiente (home office)',
    'Medio baño',
    'Cochera para 2 autos',
    'Pequeña área de jardín'
  ];

  const spacesRight = [
    '3 recámaras, cada una con baño completo'
  ];

  return (
    <section id="distribucion" className="py-20 sm:py-28 bg-white">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <AnimatedSection className="text-center mb-16">
          <h2 
            className="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mb-6"
            style={{ fontFamily: 'Playfair Display, serif' }}
          >
            Distribución de la casa
          </h2>
          <p className="text-xl text-gray-600 max-w-2xl mx-auto">
            Una propiedad pensada para familias que buscan funcionalidad, privacidad y un diseño moderno.
          </p>
        </AnimatedSection>

        {/* Lists section */}
        <AnimatedSection delay={100} className="mb-16">
          <div className="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            {/* Left column */}
            <div className="bg-emerald-50 rounded-2xl p-8">
              <ul className="space-y-4">
                {spacesLeft.map((space, index) => (
                  <li key={index} className="flex items-start gap-3">
                    <CheckCircle2 className="w-5 h-5 text-emerald-700 mt-0.5 flex-shrink-0" />
                    <span className="text-gray-700">{space}</span>
                  </li>
                ))}
              </ul>
            </div>

            {/* Right column */}
            <div className="bg-amber-50 rounded-2xl p-8">
              <ul className="space-y-4">
                {spacesRight.map((space, index) => (
                  <li key={index} className="flex items-start gap-3">
                    <CheckCircle2 className="w-5 h-5 text-amber-600 mt-0.5 flex-shrink-0" />
                    <span className="text-gray-700">{space}</span>
                  </li>
                ))}
              </ul>
              <div className="mt-6 p-4 bg-amber-100/50 rounded-xl">
                <p className="text-sm text-amber-800">
                  <strong>Beneficio extra:</strong> Cada recámara cuenta con baño completo privado para mayor comodidad y privacidad.
                </p>
              </div>
            </div>
          </div>
        </AnimatedSection>

        {/* Feature cards */}
        <AnimatedSection delay={200}>
          <div className="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <FeatureCard icon={Ruler} title="Terreno" subtitle="10 × 20 m" />
            <FeatureCard icon={Home} title="Estudio" subtitle="Home office" />
            <FeatureCard icon={MapPin} title="Jardín" subtitle="Privado" />
            <FeatureCard icon={Car} title="Cochera" subtitle="2 autos" />
          </div>
        </AnimatedSection>
      </div>
    </section>
  );
}

// Location section
function LocationSection() {
  return (
    <section id="ubicacion" className="py-20 sm:py-28 bg-gradient-to-b from-gray-50 to-white">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid lg:grid-cols-2 gap-12 items-center">
          <AnimatedSection>
            <div className="relative">
              <div className="bg-emerald-900 rounded-3xl p-8 text-white">
                <div className="w-16 h-16 bg-emerald-700 rounded-full flex items-center justify-center mb-6">
                  <MapPin className="w-8 h-8" />
                </div>
                <h2 
                  className="text-3xl sm:text-4xl font-bold mb-4"
                  style={{ fontFamily: 'Playfair Display, serif' }}
                >
                  Ubicación privilegiada
                </h2>
                <p className="text-xl text-emerald-100 mb-6">
                  Colonia El Mirador, Uruapan, Michoacán
                </p>
                <div className="h-px bg-emerald-700 my-6" />
                <p className="text-emerald-200 leading-relaxed">
                  El Mirador es una de las zonas más atractivas de Uruapan, perfecta para quienes buscan tranquilidad y plusvalía.
                </p>
              </div>
              
              {/* Decorative elements */}
              <div className="absolute -bottom-4 -right-4 w-full h-full bg-emerald-100 rounded-3xl -z-10" />
            </div>
          </AnimatedSection>

          <AnimatedSection delay={100}>
            <div className="space-y-6">
              <img
                src="https://images.pexels.com/photos/26920674/pexels-photo-26920674.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=400&w=800"
                alt="Vista de Uruapan Michoacán"
                className="w-full h-64 object-cover rounded-2xl shadow-xl"
              />
              
              <div className="flex items-start gap-4 p-6 bg-white rounded-2xl shadow-lg">
                <div className="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0">
                  <Phone className="w-6 h-6 text-emerald-800" />
                </div>
                <div>
                  <h3 className="font-semibold text-gray-900 mb-1">Contacto directo</h3>
                  <p className="text-gray-600">+52 1 452 153 9683</p>
                </div>
              </div>
            </div>
          </AnimatedSection>
        </div>
      </div>
    </section>
  );
}

// CTA section
function CTASection() {
  return (
    <section className="py-20 sm:py-28 bg-gradient-to-br from-emerald-800 via-emerald-900 to-emerald-800 text-white relative overflow-hidden">
      {/* Decorative elements */}
      <div className="absolute inset-0">
        <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-emerald-700/30 rounded-full blur-3xl" />
      </div>

      <div className="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <AnimatedSection>
          <h2 
            className="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6"
            style={{ fontFamily: 'Playfair Display, serif' }}
          >
            ¿Lista para conocer tu próximo hogar?
          </h2>
          <p className="text-xl text-emerald-100 mb-10 max-w-2xl mx-auto">
            Agenda una visita sin compromiso o escríbenos por WhatsApp. Te asesoramos paso a paso.
          </p>
          <div className="flex flex-col sm:flex-row items-center justify-center gap-4">
            <WhatsAppButton large />
          </div>
        </AnimatedSection>
      </div>
    </section>
  );
}

// Footer
function Footer() {
  return (
    <footer className="bg-emerald-950 text-white py-12">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex flex-col md:flex-row items-center justify-between gap-6">
          <div className="flex items-center gap-3">
            <div className="w-10 h-10 bg-emerald-800 rounded-lg flex items-center justify-center">
              <Home className="w-5 h-5" />
            </div>
            <div>
              <span className="text-lg font-bold" style={{ fontFamily: 'Playfair Display, serif' }}>
                ACI Grupo Inmobiliario
              </span>
              <p className="text-xs text-emerald-400">Tu próximo hogar te espera</p>
            </div>
          </div>
          
          <div className="flex items-center gap-6">
            <a 
              href="https://wa.me/5214521539683" 
              target="_blank" 
              rel="noopener noreferrer"
              className="flex items-center gap-2 text-emerald-300 hover:text-white transition-colors"
            >
              <Phone className="w-4 h-4" />
              +52 1 452 153 9683
            </a>
          </div>
        </div>
        
        <div className="mt-8 pt-8 border-t border-emerald-800 text-center">
          <p className="text-sm text-emerald-500">
            © 2024 ACI Grupo Inmobiliario. Todos los derechos reservados.
          </p>
        </div>
      </div>
    </footer>
  );
}

// Main App component
export default function App() {
  return (
    <div className="min-h-screen" style={{ fontFamily: 'Inter, system-ui, sans-serif' }}>
      <Header />
      <main>
        <HeroSection />
        <TourSection />
        <DistributionSection />
        <LocationSection />
        <CTASection />
      </main>
      <Footer />
    </div>
  );
}