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

	$accept = 'image/*';
	$multi  = ! in_array( $app, array( 'bg', 'colorkey' ), true );
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
				<span class="dropzone__note"><?php echo lumipix_icon( 'lock', 14 ); // phpcs:ignore WordPress.Security.EscapeOutput ?> <?php echo $multi ? esc_html__( 'Up to 20 images · JPG, PNG, WebP, AVIF · processed on your device', 'lumipix' ) : esc_html__( 'JPG, PNG, WebP · processed on your device', 'lumipix' ); ?></span>
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
				}
				?>
			</div>
		</div>
		<div class="tool-app__results" data-results hidden>
			<div class="results__bar">
				<p class="results__summary" data-summary aria-live="polite"></p>
				<div class="results__actions">
					<button type="button" class="btn btn--ghost btn--sm" data-clear><?php echo lumipix_icon( 'trash', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Clear', 'lumipix' ); ?></button>
					<?php if ( $multi ) : ?>
						<button type="button" class="btn btn--primary btn--sm" data-download-all hidden><?php echo lumipix_icon( 'download', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Download all', 'lumipix' ); ?></button>
					<?php endif; ?>
				</div>
			</div>
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
				<button type="button" class="segmented__btn<?php echo ( 'KB' === $unit && (float) $q === $target ) ? ' is-active' : ''; ?>" data-quick="<?php echo esc_attr( $q ); ?>"><?php echo esc_html( $q ); ?>KB</button>
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
			<select class="select" id="<?php echo esc_attr( $id ); ?>-fmt" data-opt="format">
				<option value="auto"><?php esc_html_e( 'Same as original', 'lumipix' ); ?></option>
				<option value="image/jpeg">JPG</option>
				<option value="image/png">PNG</option>
				<option value="image/webp">WebP</option>
			</select>
		</div>
	</div>
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
