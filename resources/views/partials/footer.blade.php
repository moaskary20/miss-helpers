<!-- Footer -->
<footer class="footer-section">
    <div class="container">
        <div class="row">
            <!-- معلومات الشركة -->
            <div class="col-lg-4 mb-4">
                <div class="company-info">
                    <div class="footer-logo">
                        <div class="logo-icon">
                            <i class="bi bi-house-heart"></i>
                        </div>
                        <span class="logo-text">MISS HELPERS</span>
                    </div>
                    <p class="company-description">
                        {{ __('messages.company_mission') }}
                    </p>
                </div>
            </div>
            
            <!-- روابط التنقل -->
            <div class="col-lg-4 mb-4">
                <div class="row">
                    <div class="col-6">
                        <div class="footer-links">
                            <h4>{{ __('messages.top_rated_categories') }}</h4>
                            <ul>
                                <li><a href="/{{ app()->getLocale() }}">{{ __('messages.home') }}</a></li>
                                <li><a href="{{ route('about.index', ['locale' => app()->getLocale()]) }}">{{ __('messages.about_us') }}</a></li>
                                <li><a href="{{ route('contact.index', ['locale' => app()->getLocale()]) }}">{{ __('messages.contact_us') }}</a></li>
                                @guest
                                    <li><a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">{{ __('messages.login') }}</a></li>
                                    <li><a href="#" data-bs-toggle="modal" data-bs-target="#registerModal">{{ __('messages.register') }}</a></li>
                                @else
                                    <li><a href="{{ route('auth.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('messages.logout') }}</a></li>
                                    <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                @endguest
                            </ul>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="footer-links">
                            <h4>{{ __('messages.services') }}</h4>
                            <ul>
                                <li><a href="/{{ app()->getLocale() }}">{{ __('messages.home') }}</a></li>
                                <li><a href="{{ route('maids.all.' . app()->getLocale()) }}">{{ __('messages.maids') }}</a></li>
                                <li><a href="{{ route('blog.index', ['locale' => app()->getLocale()]) }}">{{ __('messages.blogs') }}</a></li>
                                <li><a href="{{ route('service.index', ['locale' => app()->getLocale()]) }}">{{ __('messages.services') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- معلومات الاتصال -->
            <div class="col-lg-4 mb-4">
                <div class="contact-info">
                    <h4>{{ __('messages.dont_hesitate_to_share') }}</h4>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <div class="contact-details">
                            <div class="contact-value"><a href="tel:+97143430391" class="text-decoration-none text-white">+97143430391</a></div>
                            <div class="contact-hours">{{ __('messages.working_hours') }}</div>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <div class="contact-details">
                            <div class="contact-value">support@misshelpers.com</div>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="bi bi-whatsapp"></i>
                        </div>
                        <div class="contact-details">
                            <div class="contact-value"><a href="https://wa.me/97143430391" target="_blank" class="text-decoration-none text-white">+97143430391</a></div>
                            <div class="contact-hours">{{ __('messages.working_hours') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- حقوق النشر والروابط السفلية -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="copyright">
                        Miss Helpers© All rights reserved. 2025
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="footer-bottom-links">
                        <a href="{{ route('about.index', ['locale' => app()->getLocale()]) }}">{{ __('messages.about_us') }}</a>
                        <span class="separator">|</span>
                        <a href="/{{ app()->getLocale() }}">{{ __('messages.home') }}</a>
                        <span class="separator">|</span>
                        <a href="{{ route('service.index', ['locale' => app()->getLocale()]) }}">{{ __('messages.services') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- WhatsApp Floating Button -->
<div class="whatsapp-float">
    <a href="https://wa.me/97143430391" target="_blank" class="whatsapp-btn" title="تواصل معنا عبر واتساب">
        <i class="bi bi-whatsapp"></i>
    </a>
</div>

<style>
/* Footer */
.footer-section {
    background: #23336b;
    color: white;
    padding: 60px 0 0;
}

.company-info {
    margin-bottom: 30px;
}

.footer-logo {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}

.logo-icon {
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid white;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
}

.logo-text {
    font-size: 1.8rem;
    font-weight: 800;
    letter-spacing: 2px;
}

.company-description {
    color: rgba(255, 255, 255, 0.9);
    line-height: 1.7;
    font-size: 1rem;
    margin: 0;
    text-align: justify;
}

.footer-links h4 {
    color: white;
    font-size: 1.2rem;
    font-weight: 700;
    margin-bottom: 20px;
    text-align: center;
}

.footer-links ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 12px;
    text-align: center;
}

.footer-links a {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 0.95rem;
}

.footer-links a:hover {
    color: white;
    text-decoration: none;
}

.contact-info h4 {
    color: white;
    font-size: 1.2rem;
    font-weight: 700;
    margin-bottom: 25px;
    text-align: center;
}

.contact-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    margin-bottom: 20px;
}

.contact-icon {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.contact-details {
    flex: 1;
}

.contact-value {
    color: white;
    font-weight: 600;
    font-size: 1.1rem;
    margin-bottom: 5px;
}

.contact-hours {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.9rem;
    line-height: 1.4;
}

.footer-bottom {
    background: #1a2533;
    padding: 20px 0;
    margin-top: 40px;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.copyright {
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.95rem;
    text-align: center;
}

.footer-bottom-links {
    text-align: center;
}

.footer-bottom-links a {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    margin: 0 10px;
}

.footer-bottom-links a:hover {
    color: white;
    text-decoration: none;
}

.separator {
    color: rgba(255, 255, 255, 0.4);
    margin: 0 5px;
}

/* تصميم متجاوب */
@media (max-width: 991.98px) {
    .footer-section {
        padding: 50px 0 0;
    }
    
    .footer-links h4 {
        font-size: 1.1rem;
        margin-bottom: 18px;
    }
    
    .contact-info h4 {
        font-size: 1.1rem;
        margin-bottom: 22px;
    }
}

@media (max-width: 767.98px) {
    .footer-section {
        padding: 40px 0 0;
    }
    
    .footer-logo {
        justify-content: center;
        margin-bottom: 25px;
    }
    
    .logo-text {
        font-size: 1.5rem;
    }
    
    .company-description {
        text-align: center;
        font-size: 0.95rem;
    }
    
    .footer-links h4 {
        font-size: 1.1rem;
        margin-bottom: 15px;
    }
    
    .footer-links a {
        font-size: 0.9rem;
    }
    
    .contact-info h4 {
        font-size: 1.1rem;
        margin-bottom: 20px;
    }
    
    .contact-item {
        gap: 12px;
        margin-bottom: 18px;
    }
    
    .contact-icon {
        width: 35px;
        height: 35px;
        font-size: 1.1rem;
    }
    
    .contact-value {
        font-size: 1rem;
    }
    
    .contact-hours {
        font-size: 0.85rem;
    }
    
    .footer-bottom {
        padding: 15px 0;
        margin-top: 30px;
    }
    
    .copyright {
        font-size: 0.9rem;
        margin-bottom: 10px;
    }
    
    .footer-bottom-links a {
        font-size: 0.9rem;
        margin: 0 8px;
    }
}

/* WhatsApp Floating Button */
.whatsapp-float {
    position: fixed;
    bottom: 100px;
    right: 20px;
    z-index: 1000;
    animation: pulse 2s infinite;
}

.whatsapp-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
    background: #25D366;
    color: white;
    border-radius: 50%;
    text-decoration: none;
    box-shadow: 0 4px 12px rgba(37, 211, 102, 0.4);
    transition: all 0.3s ease;
    font-size: 28px;
}

.whatsapp-btn:hover {
    background: #128C7E;
    color: white;
    text-decoration: none;
    transform: scale(1.1);
    box-shadow: 0 6px 20px rgba(37, 211, 102, 0.6);
}

.whatsapp-btn i {
    font-size: 28px;
}

@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(37, 211, 102, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
    }
}

/* Mobile Responsive for WhatsApp Button */
@media (max-width: 768px) {
    .whatsapp-float {
        bottom: 80px;
        right: 15px;
    }
    
    .whatsapp-btn {
        width: 50px;
        height: 50px;
        font-size: 24px;
    }
    
    .whatsapp-btn i {
        font-size: 24px;
    }
}
</style>
