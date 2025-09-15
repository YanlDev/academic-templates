<footer class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Información de la empresa -->
            <div class="col-span-1 lg:col-span-2">
                <div class="flex items-center mb-4">
                    <div class="h-8 w-8 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-white text-sm"></i>
                    </div>
                    <span class="ml-2 text-xl font-bold">Academia Excel</span>
                </div>
                <p class="text-gray-300 mb-4 max-w-md">
                    Potenciamos el éxito académico y profesional a través de plantillas Excel profesionales,
                    servicios académicos especializados y herramientas educativas de calidad.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-facebook-f text-lg"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-instagram text-lg"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-linkedin-in text-lg"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-youtube text-lg"></i>
                    </a>
                </div>
            </div>

            <!-- Enlaces rápidos -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Enlaces Rápidos</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('templates.index') }}" class="text-gray-300 hover:text-white transition-colors">Plantillas Excel</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Servicios Académicos</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Sobre Nosotros</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Contacto</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Blog</a></li>
                </ul>
            </div>

            <!-- Servicios -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Servicios</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Revisión de Tesis</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Análisis Turnitin</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Asesoría Académica</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Cursos Online</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Certificaciones</a></li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-gray-800 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-gray-400 text-sm">
                © {{ date('Y') }} Academia Excel. Todos los derechos reservados.
            </p>
            <div class="mt-4 md:mt-0 flex space-x-6">
                <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Términos y Condiciones</a>
                <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Política de Privacidad</a>
                <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Política de Cookies</a>
            </div>
        </div>
    </div>
</footer>
