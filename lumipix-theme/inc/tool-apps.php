<?php
/**
 * Server-rendered markup for the in-browser tool apps.
 * The JavaScript in assets/js/tools/ binds to this markup.
 *
 * @package Lumipix
 */

defined( 'ABSPATH' ) || exit;

/**
 * Render a tool app for a registry key.
 *
 * @param string $key Tool key.
 * @return string
 */
function lumipix_render_tool_app( $key ) {
	$tool = lumipix_get_tool( $key );
	if ( ! $tool ) {
		return '';
	}
	$app = $tool['app'];
	lumipix_enqueue_app( $app );

	$config = isset( $tool['config'] ) ? $tool['config'] : array();
	if ( 'resize' === $app ) {
		$all              = lumipix_resize_presets();
		$config['preset'] = array();
		foreach ( isset( $config['presets'] ) ? $config['presets'] : array() as $p ) {
			if ( isset( $all[ $p ] ) ) {
				$config['preset'][ $p ] = $all[ $p ];
			}
		}
		unset( $config['presets'] );
	}

	if ( 'dpi' === $app && 'check' === ( $config['mode'] ?? '' ) ) {
		$config['changeUrl'] = lumipix_tool_url( 'change-image-dpi' );
	}

	$accept = 'image/*';
	$multi  = ! in_array( $app, array( 'bg', 'colorkey', 'favicon', 'crop' ), true );
	if ( 'convert' === $app && ! empty( $config['svg'] ) ) {
		$accept = 'image/svg+xml,.svg';
	}
	$id     = 'tool-' . sanitize_html_class( $key ) . '-' . wp_rand( 100, 999 );

	ob_start();
	?>
	<div class="tool-app tool-app--<?php echo esc_attr( $app ); ?>" id="<?php echo esc_attr( $id ); ?>" data-lumipix-app="<?php echo esc_attr( $app ); ?>" data-config="<?php echo esc_attr( wp_json_encode( $config ) ); ?>">
		<div class="tool-app__stage">
			<label class="dropzone" data-dropzone>
				<input class="visually-hidden" type="file" accept="<?php echo esc_attr( $accept ); ?>" <?php echo $multi ? 'multiple' : ''; ?> data-file-input>
				<span class="dropzone__icon"><?php echo lumipix_icon( 'upload', 26 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
				<span class="dropzone__title"><?php echo $multi ? esc_html__( 'Drop images here', 'lumipix' ) : esc_html__( 'Drop an image here', 'lumipix' ); ?></span>
				<span class="dropzone__sub"><?php esc_html_e( 'or', 'lumipix' ); ?> <span class="btn btn--primary btn--sm"><?php esc_html_e( 'Choose files', 'lumipix' ); ?></span> <span class="dropzone__paste"><?php esc_html_e( 'or paste with Ctrl+V', 'lumipix' ); ?></span></span>
				<span class="dropzone__note"><?php echo lumipix_icon( 'lock', 14 ); // phpcs:ignore WordPress.Security.EscapeOutput ?> <?php echo esc_html( lumipix_dropzone_note( $app, $config, $multi ) ); ?></span>
			</label>
			<div class="tool-app__options">
				<?php
				switch ( $app ) {
					case 'compress':
						lumipix_render_compress_options( $config, $id );
						break;
					case 'resize':
						lumipix_render_resize_options( $config, $id );
						break;
					case 'bg':
						lumipix_render_bg_options( $config, $id );
						break;
					case 'colorkey':
						lumipix_render_colorkey_options( $config, $id );
						break;
					case 'convert':
						lumipix_render_convert_options( $config, $id );
						break;
					case 'pdf':
						lumipix_render_pdf_options( $config, $id );
						break;
					case 'favicon':
						lumipix_render_favicon_options( $config, $id );
						break;
					case 'dpi':
						lumipix_render_dpi_options( $config, $id );
						break;
					case 'crop':
						lumipix_render_crop_options( $config, $id );
						break;
				}
				?>
			</div>
		</div>
		<div class="tool-app__results" data-results hidden>
			<div class="results__bar">
				<p class="results__summary" data-summary aria-live="polite"></p>
				<div class="results__actions">
					<button type="button" class="btn btn--ghost btn--sm" data-clear><?php echo lumipix_icon( 'trash', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Clear', 'lumipix' ); ?></button>
					<?php if ( 'pdf' === $app ) : ?>
						<button type="button" class="btn btn--primary btn--sm" data-pdf-create><?php echo lumipix_icon( 'file', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Create PDF', 'lumipix' ); ?></button>
					<?php elseif ( 'crop' === $app ) : ?>
						<button type="button" class="btn btn--primary btn--sm" data-crop-download><?php echo lumipix_icon( 'download', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Download', 'lumipix' ); ?></button>
					<?php elseif ( 'favicon' === $app ) : ?>
						<button type="button" class="btn btn--primary btn--sm" data-favicon-download disabled><?php echo lumipix_icon( 'download', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Download favicon package', 'lumipix' ); ?></button>
					<?php elseif ( $multi && ! ( 'dpi' === $app && 'check' === ( $config['mode'] ?? '' ) ) ) : ?>
						<button type="button" class="btn btn--primary btn--sm" data-download-all hidden><?php echo lumipix_icon( 'download', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Download all (ZIP)', 'lumipix' ); ?></button>
					<?php endif; ?>
				</div>
			</div>
			<?php if ( 'crop' === $app ) : ?>
				<div class="crop-stage" data-crop-stage></div>
			<?php elseif ( 'favicon' === $app ) : ?>
				<div class="favicon-preview" data-favicon-preview></div>
			<?php endif; ?>
			<ul class="results__list" data-list></ul>
		</div>
	</div>
	<?php
	return (string) ob_get_clean();
}

/**
 * Compress options.
 *
 * @param array<string, mixed> $c  Config.
 * @param string               $id App ID.
 */
function lumipix_render_compress_options( $c, $id ) {
	$target = isset( $c['target'] ) ? (float) $c['target'] : 100;
	$unit   = isset( $c['unit'] ) ? $c['unit'] : 'KB';
	$quick  = isset( $c['quick'] ) ? (array) $c['quick'] : array( 20, 50, 100, 200, 500 );
	$max_w  = isset( $c['maxWidth'] ) ? (int) $c['maxWidth'] : 0;
	?>
	<div class="field">
		<span class="field__label" id="<?php echo esc_attr( $id ); ?>-quick"><?php esc_html_e( 'Target size', 'lumipix' ); ?></span>
		<div class="segmented" role="group" aria-labelledby="<?php echo esc_attr( $id ); ?>-quick">
			<?php foreach ( $quick as $q ) : ?>
				<button type="button" class="segmented__btn<?php echo ( 'KB' === $unit && (float) $q === $target ) ? ' is-active' : ''; ?>" data-quick="<?php echo esc_attr( $q ); ?>"><?php echo esc_html( $q >= 1000 ? ( $q / 1000 ) . 'MB' : $q . 'KB' ); ?></button>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="field-row">
		<div class="field">
			<label class="field__label" for="<?php echo esc_attr( $id ); ?>-target"><?php esc_html_e( 'Custom size', 'lumipix' ); ?></label>
			<div class="input-group">
				<input class="input" id="<?php echo esc_attr( $id ); ?>-target" type="number" min="1" step="any" inputmode="decimal" value="<?php echo esc_attr( $target ); ?>" data-opt="target">
				<select class="select" aria-label="<?php esc_attr_e( 'Unit', 'lumipix' ); ?>" data-opt="unit">
					<option value="KB" <?php selected( $unit, 'KB' ); ?>>KB</option>
					<option value="MB" <?php selected( $unit, 'MB' ); ?>>MB</option>
				</select>
			</div>
		</div>
		<div class="field">
			<label class="field__label" for="<?php echo esc_attr( $id ); ?>-format"><?php esc_html_e( 'Save as', 'lumipix' ); ?></label>
			<select class="select" id="<?php echo esc_attr( $id ); ?>-format" data-opt="format">
				<option value="image/jpeg">JPG</option>
				<option value="image/webp">WebP</option>
			</select>
		</div>
	</div>
	<details class="advanced">
		<summary><?php esc_html_e( 'Advanced options', 'lumipix' ); ?><?php echo lumipix_icon( 'chevron', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></summary>
		<div class="field">
			<label class="field__label" for="<?php echo esc_attr( $id ); ?>-maxw"><?php esc_html_e( 'Maximum width (px, optional)', 'lumipix' ); ?></label>
			<input class="input" id="<?php echo esc_attr( $id ); ?>-maxw" type="number" min="16" step="1" placeholder="<?php esc_attr_e( 'Keep original', 'lumipix' ); ?>" value="<?php echo $max_w ? esc_attr( $max_w ) : ''; ?>" data-opt="maxWidth">
		</div>
	</details>
	<?php
}

/**
 * Resize options.
 *
 * @param array<string, mixed> $c  Config.
 * @param string               $id App ID.
 */
function lumipix_render_resize_options( $c, $id ) {
	$unit = isset( $c['unit'] ) ? $c['unit'] : 'px';
	$fit  = isset( $c['fit'] ) ? $c['fit'] : 'contain';
	$dpi  = isset( $c['dpi'] ) ? (int) $c['dpi'] : 300;
	// Presets with a fixed frame (fit set) start unlocked; the general resizer keeps the aspect ratio.
	$lock = empty( $c['fit'] );
	?>
	<?php if ( ! empty( $c['preset'] ) ) : ?>
		<div class="field">
			<span class="field__label"><?php esc_html_e( 'Presets', 'lumipix' ); ?></span>
			<div class="preset-grid">
				<?php foreach ( $c['preset'] as $pkey => $p ) : ?>
					<button type="button" class="preset" data-preset="<?php echo esc_attr( $pkey ); ?>"><?php echo esc_html( $p['label'] ); ?></button>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>
	<div class="field-row field-row--dims">
		<div class="field">
			<label class="field__label" for="<?php echo esc_attr( $id ); ?>-w"><?php esc_html_e( 'Width', 'lumipix' ); ?></label>
			<input class="input" id="<?php echo esc_attr( $id ); ?>-w" type="number" min="1" step="any" value="<?php echo esc_attr( $c['width'] ?? 1920 ); ?>" data-opt="width">
		</div>
		<button type="button" class="lock-btn" aria-pressed="false" data-lock title="<?php esc_attr_e( 'Keep aspect ratio', 'lumipix' ); ?>">
			<span class="lock-on"><?php echo lumipix_icon( 'link', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><span class="lock-off"><?php echo lumipix_icon( 'unlink', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
			<span class="visually-hidden"><?php esc_html_e( 'Keep aspect ratio', 'lumipix' ); ?></span>
		</button>
		<div class="field">
			<label class="field__label" for="<?php echo esc_attr( $id ); ?>-h"><?php esc_html_e( 'Height', 'lumipix' ); ?></label>
			<input class="input" id="<?php echo esc_attr( $id ); ?>-h" type="number" min="1" step="any" value="<?php echo esc_attr( $c['height'] ?? 1080 ); ?>" data-opt="height">
		</div>
		<div class="field">
			<label class="field__label" for="<?php echo esc_attr( $id ); ?>-unit"><?php esc_html_e( 'Unit', 'lumipix' ); ?></label>
			<select class="select" id="<?php echo esc_attr( $id ); ?>-unit" data-opt="unit">
				<?php
				foreach ( array( 'px' => 'px', '%' => '%', 'cm' => 'cm', 'mm' => 'mm', 'in' => 'inch' ) as $v => $label ) {
					printf( '<option value="%s"%s>%s</option>', esc_attr( $v ), selected( $unit, $v, false ), esc_html( $label ) );
				}
				?>
			</select>
		</div>
	</div>
	<div class="field-row">
		<div class="field" data-dpi-field>
			<label class="field__label" for="<?php echo esc_attr( $id ); ?>-dpi"><?php esc_html_e( 'DPI', 'lumipix' ); ?></label>
			<input class="input" id="<?php echo esc_attr( $id ); ?>-dpi" type="number" min="30" max="1200" step="1" value="<?php echo esc_attr( $dpi ); ?>" data-opt="dpi">
		</div>
		<div class="field" data-fit-field>
			<label class="field__label" for="<?php echo esc_attr( $id ); ?>-fit"><?php esc_html_e( 'Fit', 'lumipix' ); ?></label>
			<select class="select" id="<?php echo esc_attr( $id ); ?>-fit" data-opt="fit">
				<option value="contain" <?php selected( $fit, 'contain' ); ?>><?php esc_html_e( 'Fit – add background', 'lumipix' ); ?></option>
				<option value="cover" <?php selected( $fit, 'cover' ); ?>><?php esc_html_e( 'Fill – crop edges', 'lumipix' ); ?></option>
				<option value="stretch" <?php selected( $fit, 'stretch' ); ?>><?php esc_html_e( 'Stretch', 'lumipix' ); ?></option>
			</select>
		</div>
		<div class="field" data-bg-field>
			<label class="field__label" for="<?php echo esc_attr( $id ); ?>-bg"><?php esc_html_e( 'Background', 'lumipix' ); ?></label>
			<input class="input input--color" id="<?php echo esc_attr( $id ); ?>-bg" type="color" value="#ffffff" data-opt="background">
		</div>
		<div class="field">
			<label class="field__label" for="<?php echo esc_attr( $id ); ?>-fmt"><?php esc_html_e( 'Save as', 'lumipix' ); ?></label>
			<?php $fmt = isset( $c['format'] ) ? $c['format'] : 'auto'; ?>
			<select class="select" id="<?php echo esc_attr( $id ); ?>-fmt" data-opt="format">
				<option value="auto" <?php selected( $fmt, 'auto' ); ?>><?php esc_html_e( 'Same as original', 'lumipix' ); ?></option>
				<option value="image/jpeg" <?php selected( $fmt, 'image/jpeg' ); ?>>JPG</option>
				<option value="image/png" <?php selected( $fmt, 'image/png' ); ?>>PNG</option>
				<option value="image/webp" <?php selected( $fmt, 'image/webp' ); ?>>WebP</option>
			</select>
		</div>
	</div>
	<?php if ( isset( $c['sheet'] ) ) : ?>
		<div class="field">
			<label class="field__label" for="<?php echo esc_attr( $id ); ?>-sheet"><?php esc_html_e( 'Print sheet', 'lumipix' ); ?></label>
			<select class="select" id="<?php echo esc_attr( $id ); ?>-sheet" data-opt="sheet">
				<option value="" <?php selected( $c['sheet'], '' ); ?>><?php esc_html_e( 'Single photo', 'lumipix' ); ?></option>
				<option value="15x10cm" <?php selected( $c['sheet'], '15x10cm' ); ?>><?php esc_html_e( '10×15 cm photo paper', 'lumipix' ); ?></option>
				<option value="6x4in" <?php selected( $c['sheet'], '6x4in' ); ?>><?php esc_html_e( '4×6 in photo paper', 'lumipix' ); ?></option>
			</select>
		</div>
	<?php endif; ?>
	<p class="field__hint" data-dims-hint></p>
	<input type="hidden" data-opt="lockDefault" value="<?php echo $lock ? '1' : '0'; ?>">
	<?php
}

/**
 * Background remover options.
 *
 * @param array<string, mixed> $c  Config.
 * @param string               $id App ID.
 */
function lumipix_render_bg_options( $c, $id ) {
	?>
	<div class="field">
		<span class="field__label" id="<?php echo esc_attr( $id ); ?>-bgl"><?php esc_html_e( 'New background', 'lumipix' ); ?></span>
		<div class="swatches" role="radiogroup" aria-labelledby="<?php echo esc_attr( $id ); ?>-bgl">
			<button type="button" class="swatch swatch--transparent is-active" role="radio" aria-checked="true" data-bg="transparent"><span class="visually-hidden"><?php esc_html_e( 'Transparent', 'lumipix' ); ?></span></button>
			<button type="button" class="swatch" role="radio" aria-checked="false" data-bg="#ffffff" style="--swatch:#ffffff"><span class="visually-hidden"><?php esc_html_e( 'White', 'lumipix' ); ?></span></button>
			<button type="button" class="swatch" role="radio" aria-checked="false" data-bg="#0e0f1c" style="--swatch:#0e0f1c"><span class="visually-hidden"><?php esc_html_e( 'Black', 'lumipix' ); ?></span></button>
			<button type="button" class="swatch" role="radio" aria-checked="false" data-bg="#2f6bff" style="--swatch:#2f6bff"><span class="visually-hidden"><?php esc_html_e( 'Blue', 'lumipix' ); ?></span></button>
			<button type="button" class="swatch" role="radio" aria-checked="false" data-bg="#ffd9e6" style="--swatch:#ffd9e6"><span class="visually-hidden"><?php esc_html_e( 'Pink', 'lumipix' ); ?></span></button>
			<label class="swatch swatch--custom" title="<?php esc_attr_e( 'Custom colour', 'lumipix' ); ?>"><input type="color" value="#ffb547" data-bg-custom><span class="visually-hidden"><?php esc_html_e( 'Custom colour', 'lumipix' ); ?></span></label>
		</div>
	</div>
	<div class="model-status" data-model-status>
		<span class="model-status__dot"></span>
		<span data-model-text><?php esc_html_e( 'The AI model downloads once, then runs on your device. Your photo is never uploaded.', 'lumipix' ); ?></span>
		<span class="progress" hidden data-model-progress><span></span></span>
	</div>
	<?php
}

/**
 * Colour-key (white background remover) options.
 *
 * @param array<string, mixed> $c  Config.
 * @param string               $id App ID.
 */
function lumipix_render_colorkey_options( $c, $id ) {
	$color = isset( $c['color'] ) ? $c['color'] : '#ffffff';
	?>
	<div class="field-row">
		<div class="field">
			<label class="field__label" for="<?php echo esc_attr( $id ); ?>-color"><?php esc_html_e( 'Colour to remove', 'lumipix' ); ?></label>
			<div class="input-group">
				<input class="input input--color" id="<?php echo esc_attr( $id ); ?>-color" type="color" value="<?php echo esc_attr( $color ); ?>" data-opt="color">
				<button type="button" class="btn btn--ghost btn--sm" aria-pressed="false" data-pick><?php echo lumipix_icon( 'pipette', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Pick from image', 'lumipix' ); ?></button>
			</div>
		</div>
	</div>
	<div class="field">
		<label class="field__label" for="<?php echo esc_attr( $id ); ?>-tol"><?php esc_html_e( 'Tolerance', 'lumipix' ); ?> <output data-out="tolerance"><?php echo esc_html( $c['tolerance'] ?? 18 ); ?></output></label>
		<input class="range" id="<?php echo esc_attr( $id ); ?>-tol" type="range" min="0" max="100" value="<?php echo esc_attr( $c['tolerance'] ?? 18 ); ?>" data-opt="tolerance">
	</div>
	<div class="field">
		<label class="field__label" for="<?php echo esc_attr( $id ); ?>-fea"><?php esc_html_e( 'Edge softness', 'lumipix' ); ?> <output data-out="feather"><?php echo esc_html( $c['feather'] ?? 12 ); ?></output></label>
		<input class="range" id="<?php echo esc_attr( $id ); ?>-fea" type="range" min="0" max="60" value="<?php echo esc_attr( $c['feather'] ?? 12 ); ?>" data-opt="feather">
	</div>
	<?php
}

/**
 * Small print under the dropzone.
 *
 * @param string               $app    App.
 * @param array<string, mixed> $config Config.
 * @param bool                 $multi  Multiple files allowed.
 * @return string
 */
function lumipix_dropzone_note( $app, $config, $multi ) {
	if ( 'convert' === $app && ! empty( $config['svg'] ) ) {
		return __( 'Up to 20 SVG files · processed on your device', 'lumipix' );
	}
	if ( 'favicon' === $app ) {
		return __( 'PNG, SVG, JPG or WebP logo – or switch to Text · processed on your device', 'lumipix' );
	}
	if ( 'pdf' === $app ) {
		return __( 'Up to 20 images, one per page · processed on your device', 'lumipix' );
	}
	return $multi ? __( 'Up to 20 images · JPG, PNG, WebP, AVIF · processed on your device', 'lumipix' ) : __( 'JPG, PNG, WebP · processed on your device', 'lumipix' );
}

/**
 * Format converter options.
 *
 * @param array<string, mixed> $c  Config.
 * @param string               $id App ID.
 */
function lumipix_render_convert_options( $c, $id ) {
	$to = isset( $c['to'] ) ? $c['to'] : 'image/jpeg';
	?>
	<div class="field-row">
		<div class="field">
			<label class="field__label" for="<?php echo esc_attr( $id ); ?>-to"><?php esc_html_e( 'Convert to', 'lumipix' ); ?></label>
			<select class="select" id="<?php echo esc_attr( $id ); ?>-to" data-opt="to">
				<option value="image/jpeg" <?php selected( $to, 'image/jpeg' ); ?>>JPG</option>
				<option value="image/png" <?php selected( $to, 'image/png' ); ?>>PNG</option>
				<option value="image/webp" <?php selected( $to, 'image/webp' ); ?>>WebP</option>
			</select>
		</div>
		<div class="field" data-bg-field>
			<label class="field__label" for="<?php echo esc_attr( $id ); ?>-bg"><?php esc_html_e( 'Background', 'lumipix' ); ?></label>
			<input class="input input--color" id="<?php echo esc_attr( $id ); ?>-bg" type="color" value="#ffffff" data-opt="background">
		</div>
	</div>
	<div class="field" data-quality-field>
		<label class="field__label" for="<?php echo esc_attr( $id ); ?>-q"><?php esc_html_e( 'Quality', 'lumipix' ); ?> <output data-out="quality"><?php echo esc_html( $c['quality'] ?? 92 ); ?></output></label>
		<input class="range" id="<?php echo esc_attr( $id ); ?>-q" type="range" min="1" max="100" value="<?php echo esc_attr( $c['quality'] ?? 92 ); ?>" data-opt="quality">
	</div>
	<?php if ( ! empty( $c['svg'] ) ) : ?>
		<div class="field" data-svg-field>
			<span class="field__label" id="<?php echo esc_attr( $id ); ?>-scale"><?php esc_html_e( 'Size', 'lumipix' ); ?></span>
			<div class="field-row">
				<div class="segmented" role="group" aria-labelledby="<?php echo esc_attr( $id ); ?>-scale">
					<?php foreach ( array( 1, 2, 4 ) as $sc ) : ?>
						<button type="button" class="segmented__btn<?php echo 1 === $sc ? ' is-active' : ''; ?>" data-scale="<?php echo esc_attr( $sc ); ?>"><?php echo esc_html( $sc . '×' ); ?></button>
					<?php endforeach; ?>
				</div>
				<input class="input" type="number" min="16" max="16384" step="1" inputmode="numeric" placeholder="<?php esc_attr_e( 'Custom width (px)', 'lumipix' ); ?>" aria-label="<?php esc_attr_e( 'Custom width in pixels', 'lumipix' ); ?>" data-opt="svgWidth">
			</div>
		</div>
	<?php endif; ?>
	<?php
}

/**
 * Image to PDF options.
 *
 * @param array<string, mixed> $c  Config.
 * @param string               $id App ID.
 */
function lumipix_render_pdf_options( $c, $id ) {
	$selects = array(
		'page'    => array( __( 'Page size', 'lumipix' ), array( 'a4' => 'A4', 'letter' => __( 'US Letter', 'lumipix' ), 'fit' => __( 'Same as image', 'lumipix' ) ), 'a4' ),
		'orient'  => array( __( 'Orientation', 'lumipix' ), array( 'auto' => __( 'Auto', 'lumipix' ), 'portrait' => __( 'Portrait', 'lumipix' ), 'landscape' => __( 'Landscape', 'lumipix' ) ), 'auto' ),
		'margin'  => array( __( 'Margin', 'lumipix' ), array( '0' => __( 'None', 'lumipix' ), '20' => __( 'Small', 'lumipix' ), '40' => __( 'Large', 'lumipix' ) ), '20' ),
		'quality' => array( __( 'Quality', 'lumipix' ), array( 'high' => __( 'High', 'lumipix' ), 'balanced' => __( 'Balanced', 'lumipix' ), 'small' => __( 'Smaller file', 'lumipix' ) ), 'balanced' ),
	);
	?>
	<div class="field-row field-row--4">
		<?php foreach ( $selects as $key => $s ) : ?>
			<div class="field">
				<label class="field__label" for="<?php echo esc_attr( $id . '-' . $key ); ?>"><?php echo esc_html( $s[0] ); ?></label>
				<select class="select" id="<?php echo esc_attr( $id . '-' . $key ); ?>" data-opt="<?php echo esc_attr( $key ); ?>">
					<?php foreach ( $s[1] as $v => $label ) : ?>
						<option value="<?php echo esc_attr( $v ); ?>" <?php selected( $s[2], (string) $v ); ?>><?php echo esc_html( $label ); ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		<?php endforeach; ?>
	</div>
	<p class="field__hint"><?php esc_html_e( 'Drag the images or use the arrows to change the page order.', 'lumipix' ); ?></p>
	<?php
}

/**
 * Favicon generator options.
 *
 * @param array<string, mixed> $c  Config.
 * @param string               $id App ID.
 */
function lumipix_render_favicon_options( $c, $id ) {
	?>
	<div class="field">
		<span class="field__label" id="<?php echo esc_attr( $id ); ?>-mode"><?php esc_html_e( 'Create from', 'lumipix' ); ?></span>
		<div class="segmented" role="group" aria-labelledby="<?php echo esc_attr( $id ); ?>-mode">
			<button type="button" class="segmented__btn is-active" data-mode="image"><?php esc_html_e( 'Image', 'lumipix' ); ?></button>
			<button type="button" class="segmented__btn" data-mode="text"><?php esc_html_e( 'Text', 'lumipix' ); ?></button>
		</div>
	</div>
	<div class="field-row" data-text-fields hidden>
		<div class="field">
			<label class="field__label" for="<?php echo esc_attr( $id ); ?>-text"><?php esc_html_e( 'Text', 'lumipix' ); ?></label>
			<input class="input" id="<?php echo esc_attr( $id ); ?>-text" type="text" maxlength="4" value="L" data-opt="text">
		</div>
		<div class="field">
			<label class="field__label" for="<?php echo esc_attr( $id ); ?>-font"><?php esc_html_e( 'Font', 'lumipix' ); ?></label>
			<select class="select" id="<?php echo esc_attr( $id ); ?>-font" data-opt="font">
				<option value="sans"><?php esc_html_e( 'Sans', 'lumipix' ); ?></option>
				<option value="bold"><?php esc_html_e( 'Bold', 'lumipix' ); ?></option>
				<option value="serif"><?php esc_html_e( 'Serif', 'lumipix' ); ?></option>
			</select>
		</div>
		<div class="field">
			<label class="field__label" for="<?php echo esc_attr( $id ); ?>-color"><?php esc_html_e( 'Text colour', 'lumipix' ); ?></label>
			<input class="input input--color" id="<?php echo esc_attr( $id ); ?>-color" type="color" value="#ffffff" data-opt="color">
		</div>
	</div>
	<div class="field-row">
		<div class="field">
			<label class="field__label" for="<?php echo esc_attr( $id ); ?>-shape"><?php esc_html_e( 'Shape', 'lumipix' ); ?></label>
			<select class="select" id="<?php echo esc_attr( $id ); ?>-shape" data-opt="shape">
				<option value="square"><?php esc_html_e( 'Square', 'lumipix' ); ?></option>
				<option value="rounded" selected><?php esc_html_e( 'Rounded', 'lumipix' ); ?></option>
				<option value="circle"><?php esc_html_e( 'Circle', 'lumipix' ); ?></option>
			</select>
		</div>
		<div class="field">
			<label class="field__label" for="<?php echo esc_attr( $id ); ?>-bg"><?php esc_html_e( 'Background', 'lumipix' ); ?></label>
			<div class="input-group">
				<input class="input input--color" id="<?php echo esc_attr( $id ); ?>-bg" type="color" value="#5b3df5" data-opt="background">
				<label class="check" data-transparent-field><input type="checkbox" data-transparent checked> <?php esc_html_e( 'Transparent', 'lumipix' ); ?></label>
			</div>
		</div>
	</div>
	<div class="field">
		<label class="field__label" for="<?php echo esc_attr( $id ); ?>-pad"><?php esc_html_e( 'Padding', 'lumipix' ); ?> <output data-out="padding">8%</output></label>
		<input class="range" id="<?php echo esc_attr( $id ); ?>-pad" type="range" min="0" max="30" value="8" data-opt="padding">
	</div>
	<?php
}

/**
 * DPI changer / checker options.
 *
 * @param array<string, mixed> $c  Config.
 * @param string               $id App ID.
 */
function lumipix_render_dpi_options( $c, $id ) {
	if ( 'check' === ( $c['mode'] ?? '' ) ) {
		?>
		<p class="field__hint field__hint--box"><?php echo lumipix_icon( 'shield', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?> <?php esc_html_e( 'Drop JPG, PNG or other images to read their DPI, pixel size and how large they print sharply. Nothing is changed.', 'lumipix' ); ?></p>
		<?php
		return;
	}
	$dpi = isset( $c['dpi'] ) ? (int) $c['dpi'] : 300;
	?>
	<div class="field">
		<span class="field__label" id="<?php echo esc_attr( $id ); ?>-dpiq"><?php esc_html_e( 'New DPI', 'lumipix' ); ?></span>
		<div class="segmented" role="group" aria-labelledby="<?php echo esc_attr( $id ); ?>-dpiq">
			<?php foreach ( array( 72, 96, 150, 200, 300, 600 ) as $q ) : ?>
				<button type="button" class="segmented__btn<?php echo $q === $dpi ? ' is-active' : ''; ?>" data-dpi-quick="<?php echo esc_attr( $q ); ?>"><?php echo esc_html( $q ); ?></button>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="field">
		<label class="field__label" for="<?php echo esc_attr( $id ); ?>-dpi"><?php esc_html_e( 'Custom DPI', 'lumipix' ); ?></label>
		<input class="input" id="<?php echo esc_attr( $id ); ?>-dpi" type="number" min="1" max="2400" step="1" inputmode="numeric" value="<?php echo esc_attr( $dpi ); ?>" data-opt="dpi">
	</div>
	<?php
}

/**
 * Crop options.
 *
 * @param array<string, mixed> $c  Config.
 * @param string               $id App ID.
 */
function lumipix_render_crop_options( $c, $id ) {
	$ratios = array( 'free' => __( 'Free', 'lumipix' ), '1:1' => '1:1', '4:5' => '4:5', '3:4' => '3:4', '2:3' => '2:3', '16:9' => '16:9', '9:16' => '9:16', '4:3' => '4:3', '3:2' => '3:2' );
	?>
	<div class="field">
		<span class="field__label" id="<?php echo esc_attr( $id ); ?>-ratio"><?php esc_html_e( 'Aspect ratio', 'lumipix' ); ?></span>
		<div class="preset-grid preset-grid--ratios" role="group" aria-labelledby="<?php echo esc_attr( $id ); ?>-ratio">
			<?php foreach ( $ratios as $v => $label ) : ?>
				<button type="button" class="preset<?php echo 'free' === $v ? ' is-active' : ''; ?>" data-aspect="<?php echo esc_attr( $v ); ?>"><?php echo esc_html( $label ); ?></button>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="field-row field-row--crop">
		<div class="field">
			<label class="field__label" for="<?php echo esc_attr( $id ); ?>-cw"><?php esc_html_e( 'Width (px)', 'lumipix' ); ?></label>
			<input class="input" id="<?php echo esc_attr( $id ); ?>-cw" type="number" min="1" step="1" inputmode="numeric" data-crop-w disabled>
		</div>
		<div class="field">
			<label class="field__label" for="<?php echo esc_attr( $id ); ?>-ch"><?php esc_html_e( 'Height (px)', 'lumipix' ); ?></label>
			<input class="input" id="<?php echo esc_attr( $id ); ?>-ch" type="number" min="1" step="1" inputmode="numeric" data-crop-h disabled>
		</div>
		<div class="field">
			<label class="field__label" for="<?php echo esc_attr( $id ); ?>-fmt"><?php esc_html_e( 'Save as', 'lumipix' ); ?></label>
			<select class="select" id="<?php echo esc_attr( $id ); ?>-fmt" data-opt="format">
				<option value="auto"><?php esc_html_e( 'Same as original', 'lumipix' ); ?></option>
				<option value="image/jpeg">JPG</option>
				<option value="image/png">PNG</option>
				<option value="image/webp">WebP</option>
			</select>
		</div>
	</div>
	<div class="btn-row">
		<button type="button" class="btn btn--ghost btn--sm" data-rotate="-90" disabled><?php echo lumipix_icon( 'rotate-left', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Rotate left', 'lumipix' ); ?></button>
		<button type="button" class="btn btn--ghost btn--sm" data-rotate="90" disabled><?php echo lumipix_icon( 'rotate-right', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Rotate right', 'lumipix' ); ?></button>
		<button type="button" class="btn btn--ghost btn--sm" data-flip disabled><?php echo lumipix_icon( 'flip', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Flip', 'lumipix' ); ?></button>
	</div>
	<?php
}
