<?php $settings = $this->get_settings_for_display();
    $subtitle_tag = $settings['hero_subtitle_html_tag'];
    $title_tag = $settings['hero_title_html_tag']
?>
<div class="edubin-hero edubin-hero-section-<?php echo $settings['edubin_hero_style']; ?> ">
    <div class="container">
            
        <!-- Hero Content Start -->
        <div class="hero-content">
            <!-- Subtitle -->
            <?php if ($settings['sub_title']): ?>
                <<?php echo $subtitle_tag?> class="subtitle aos-init aos-animate" data-aos="fade-up" data-aos-delay="800"><?php echo $settings['sub_title']; ?></<?php echo $subtitle_tag?>>
            <?php endif; ?>
            <!-- Title -->
            <?php if ($settings['title']): ?>
                <<?php echo $title_tag?> class="title aos-init aos-animate" data-aos="fade-up" data-aos-delay="800"><?php echo $settings['title']; ?></<?php echo $title_tag?>>
            <?php endif; ?>   

            <?php if ($settings['button_text']): ?>
                <div class="hero-btn aos-init aos-animate" data-aos="fade-up" data-aos-delay="900">
                    <a class="edubin-btn"  <?php echo ($settings['button_link']["is_external"] == 'on') ? 'target="_blank"' : '' ; ?> href="<?php echo esc_url($settings['button_link']['url']); ?>"><?php echo $settings['button_text']; ?></a>
                </div>
            <?php endif; ?>
        </div>
        <!-- Hero Content End -->
    </div>

    <div class="shape-svg">
		<svg xmlns="http://www.w3.org/2000/svg" width="1998px" height="192px">
			<path d="M1973.999,0.0 L0.0,119.999 L1997.999,191.999 L1973.999,0.0 Z"></path>
		</svg>
	</div>
</div>
