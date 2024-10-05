<?php $settings = $this->get_settings_for_display();
$subtitle_tag = $settings['hero_subtitle_html_tag'];
$title_tag = $settings['hero_title_html_tag']
?>

<div class="edubin-hero edubin-hero-section-<?php echo $settings['edubin_hero_style']; ?>">
	<div class="shape-01"></div>
	<div class="svg-shape2">
		<svg xmlns="http://www.w3.org/2000/svg" width="76px" height="87px">
			<path d="M0.2,42.188 L74.477,87.2 L75.999,0.1 L0.2,42.188 "></path>
		</svg>
	</div>
	<div class="svg-shape3">
		<svg xmlns="http://www.w3.org/2000/svg" width="299px" height="170px">
			<path d="M0.753,1.434 L1.246,0.564 L298.246,168.564 L297.753,169.434 L0.753,1.434 Z"></path>
		</svg>
	</div>
	<div class="svg-shape4">
		<svg xmlns="http://www.w3.org/2000/svg" width="377px" height="433px">
			<path d="M0.261,209.805 L369.361,432.234 L376.902,0.399 L0.261,209.805 "></path>
		</svg>
	</div>
	<div class="svg-shape5">
		<svg xmlns="http://www.w3.org/2000/svg" width="1186.5px" height="547.5px">
			<path d="M364.499,1.499 L1.499,457.499 L1159.499,544.499 L1183.499,466.499 L364.499,1.499 Z"></path>
		</svg>
	</div>
	<div class="container">
		<div class="row align-items-center">
			<div class="col-xl-7 col-lg-8 col-md-10">
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
					<!-- Additional Text  -->
                    <?php if ($settings['description_text']): ?>
                        <p class="description-text aos-init aos-animate" data-aos="fade-up" data-aos-delay="900"><?php echo $settings['description_text']; ?></p>
                    <?php endif; ?>

                    <?php if ($settings['button_text']): ?>
                        <div class="hero-btn aos-init aos-animate" data-aos="fade-up" data-aos-delay="1000">
                            <a class="edubin-btn"  <?php echo ($settings['button_link']["is_external"] == 'on') ? 'target="_blank"' : '' ; ?> href="<?php echo esc_url($settings['button_link']['url']); ?>"><?php echo $settings['button_text']; ?></a>
                        </div>
                    <?php endif; ?>
				</div>
				<!-- Hero Content End -->
			</div>
		</div>
	</div>
</div>