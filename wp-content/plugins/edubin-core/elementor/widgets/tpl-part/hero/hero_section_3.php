<?php $settings = $this->get_settings_for_display();
$title_tag = $settings['hero_title_html_tag']
?>
<div class="edubin-hero edubin-hero-section-<?php echo $settings['edubin_hero_style']; ?> ">
    <div class="container">
            
        <!-- Hero Content Start -->
        <div class="hero-content">
            <!-- Title -->
            <?php if ($settings['title']): ?>
                <<?php echo $title_tag?> class="title aos-init aos-animate" data-aos="fade-up" data-aos-delay="800"><?php echo $settings['title']; ?></<?php echo $title_tag?>>
            <?php endif; ?>

            <!-- Additional Text  -->
            <?php if ($settings['description_text']): ?>
                <p class="description-text aos-init aos-animate" data-aos="fade-up" data-aos-delay="800"><?php echo $settings['description_text']; ?></p>
            <?php endif; ?>

            <?php if ($settings['button_text']): ?>
                <div class="hero-btn aos-init aos-animate" data-aos="fade-up" data-aos-delay="900">
                    <a class="edubin-btn"  <?php echo ($settings['button_link']["is_external"] == 'on') ? 'target="_blank"' : '' ; ?> href="<?php echo esc_url($settings['button_link']['url']); ?>"><?php echo $settings['button_text']; ?></a>
                </div>
            <?php endif; ?>
        </div>
        <!-- Hero Content End -->
        
        <div class="shape-svg">
            <svg xmlns="http://www.w3.org/2000/svg" width="1998px" height="192px">
                <path d="M1973.999,0.0 L0.0,119.999 L1997.999,191.999 L1973.999,0.0 Z"></path>
            </svg>
        </div>
        <div class="shape-svg-02">
            <svg xmlns="http://www.w3.org/2000/svg" width="2187px" height="261px">
                <path d="M197.999,179.999 L2092.999,0.0 L2186.999,137.999 L0.0,260.999 L197.999,179.999 Z"></path>
            </svg>
        </div>
        <div class="shape-svg-03">
            <svg xmlns="http://www.w3.org/2000/svg" width="2183px" height="329px">
                <path d="M195.589,240.666 L2033.741,0.615 L2182.163,133.847 L0.335,328.78 L195.589,240.666 Z"></path>
            </svg>
        </div>
    </div>
</div>

