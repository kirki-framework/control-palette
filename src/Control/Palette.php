<?php
/**
 * Customizer Control: palette.
 *
 * @package   kirki-framework/control-palette
 * @copyright Copyright (c) 2019, Ari Stathopoulos (@aristath)
 * @license   https://opensource.org/licenses/MIT
 * @since     1.0
 */

namespace Kirki\Control;

use Kirki\Control\Base;
use Kirki\URL;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Palette control (modified radio).
 *
 * @since 1.0
 */
class Palette extends Base {

	/**
	 * The control type.
	 *
	 * @access public
	 * @since 1.0
	 * @var string
	 */
	public $type = 'kirki-palette';

	/**
	 * The version. Used in scripts & styles for cache-busting.
	 *
	 * @static
	 * @access private
	 * @since 1.0
	 * @var string
	 */
	private static $control_ver = '1.0';

	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @access public
	 * @since 1.0
	 * @return void
	 */
	public function enqueue() {
		parent::enqueue();

		// Enqueue the script.
		wp_enqueue_script( 'kirki-control-palette', URL::get_from_path( dirname( __DIR__ ) . '/assets/scripts/control.js' ), [ 'jquery', 'customize-base', 'kirki-dynamic-control' ], self::$control_ver, false );

		// Enqueue the style.
		wp_enqueue_style( 'kirki-control-palette-style', URL::get_from_path( dirname( __DIR__ ) . '/assets/styles/style.css' ), [], self::$control_ver );
	}

	/**
	 * An Underscore (JS) template for this control's content (but not its container).
	 *
	 * Class variables for this control class are available in the `data` JS object;
	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
	 *
	 * @see WP_Customize_Control::print_template()
	 *
	 * @access protected
	 * @since 1.0
	 * @return void
	 */
	protected function content_template() {
		?>
		<# if ( ! data.choices ) { return; } #>
		<span class="customize-control-title">
			{{{ data.label }}}
		</span>
		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>
		<div id="input_{{ data.id }}" class="buttonset">
			<# for ( key in data.choices ) { #>
				<input {{{ data.inputAttrs }}} type="radio" value="{{ key }}" name="_customize-palette-{{ data.id }}" id="{{ data.id }}{{ key }}" {{{ data.link }}}<# if ( data.value == key ) { #> checked<# } #>>
					<label for="{{ data.id }}{{ key }}">
						<# for ( color in data.choices[ key ] ) { #>
							<span style='background: {{ data.choices[ key ][ color ] }}'>{{ data.choices[ key ][ color ] }}</span>
						<# } #>
					</label>
				</input>
			<# } #>
		</div>
		<?php
	}
}
