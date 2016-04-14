<?php

if ( ! class_exists('XmlExportFiltering') )
{
	class XmlExportFiltering
	{
		private $queryWhere = "";
		private $queryJoin = array();
		private $userWhere = "";
		private $userJoin = array();
		private $options;		
		private $tax_query = false;
		private $meta_query = false;		

		public function __construct($args = array())
		{
			$this->options = $args;						

			add_filter('wp_all_export_single_filter_rule', array(&$this, 'parse_rule_value'), 10, 1);
		}

		public static function render_filtering_block( $engine, $isWizard, $post, $is_on_template_screen = false )
		{
			?>
			<input type="hidden" class="hierarhy-output" name="filter_rules_hierarhy" value="<?php echo esc_html($post['filter_rules_hierarhy']);?>"/>
			<?php

			if ( $isWizard or $post['export_type'] != 'specific' ) return;
			
			?>
			<div class="wpallexport-collapsed wpallexport-section closed">
				<div class="wpallexport-content-section wpallexport-filtering-section" <?php if ($is_on_template_screen):?>style="margin-bottom: 10px;"<?php endif; ?>>
					<div class="wpallexport-collapsed-header" style="padding-left: 25px;">
						<h3><?php _e('Filters','wp_all_export_plugin');?></h3>	
					</div>
					<div class="wpallexport-collapsed-content" style="padding: 0;">
						<div class="wpallexport-collapsed-content-inner">									
							<?php include_once PMXE_ROOT_DIR . '/views/admin/export/blocks/filters.php'; ?>
						</div>											
					</div>
				</div>
			</div>	
			<?php
		}

		/**
	     * __get function.
	     *
	     * @access public
	     * @param mixed $key
	     * @return mixed
	     */
	    public function __get( $key ) {
	        return $this->get( $key );
	    }	

	    /**
	     * Get a session variable
	     *
	     * @param string $key
	     * @param  mixed $default used if the session variable isn't set
	     * @return mixed value of session variable
	     */
	    public function get( $key, $default = null ) {        
	        return isset( $this->{$key} ) ? $this->{$key} : $default;
	    }
	}
}