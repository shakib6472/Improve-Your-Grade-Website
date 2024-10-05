<?php $settings = $this->get_settings_for_display();

$subtitle_tag = $settings['hero_subtitle_html_tag'];
$title_tag = $settings['hero_title_html_tag']

?>

<div class="edubin-hero edubin-hero-section-<?php echo $settings['edubin_hero_style']; ?> ">
    <div class="container">
        <div class="row">
            <div class="edubin-col-xl-7 edubin-col-lg-8 edubin-col-md-10">
                <!-- Hero Content Start -->
                <div class="hero-content">
                    <!-- Subtitle -->
                    <?php if ($settings['sub_title']): ?>
                        <<?php echo $subtitle_tag?> class="subtitle aos-init aos-animate" data-aos="fade-up" data-aos-delay="700"><?php echo $settings['sub_title']; ?></ <?php echo $subtitle_tag?>>
                    <?php endif; ?>
                    <!-- Title -->
                    <?php if ($settings['title']): ?>
                        <<?php echo $title_tag?> class="title aos-init aos-animate" data-aos="fade-up" data-aos-delay="800"><?php echo $settings['title']; ?></<?php echo $title_tag?>>
                    <?php endif; ?>
                    <!-- Button -->
                    <?php if ($settings['button_text']): ?>
                        <div class="hero-btn aos-init aos-animate" data-aos="fade-up" data-aos-delay="900">
                            <a class="edubin-btn"  <?php echo ($settings['button_link']["is_external"] == 'on') ? 'target="_blank"' : '' ; ?> href="<?php echo esc_url($settings['button_link']['url']); ?>"><?php echo $settings['button_text']; ?></a>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- Hero Content End -->
            </div>
        </div>
    </div>
    <div class="hero-bottom-svg">
		<svg id="svg" viewBox="0, 0, 400,27.708333333333336">
			<g id="svgg">
				<path id="path0" d="M0.000 13.854 L 0.000 27.708 200.000 27.708 L 400.000 27.708 400.000 14.216 L 400.000 0.725 395.573 1.822 C 322.012 20.064,241.242 29.243,178.709 26.467 C 123.876 24.033,57.451 14.315,4.123 0.926 C 2.094 0.417,0.336 0.000,0.217 0.000 C 0.069 0.000,0.000 4.399,0.000 13.854"></path>
			</g>
		</svg>
	</div>
</div>

