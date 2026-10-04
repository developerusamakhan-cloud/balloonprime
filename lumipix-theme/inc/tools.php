<?php
/**
 * Tool registry.
 *
 * Every tool landing page (main tools and their presets) is described here.
 * Pages are linked to an entry through the `_lumipix_tool` post meta, which
 * the installer sets automatically and editors can change in the page sidebar.
 *
 * Keys:
 *  - app      Which in-browser app to mount: compress | resize | bg | colorkey
 *  - group    Hub the tool belongs to (see lumipix_tool_groups()).
 *  - parent   Main tool key this preset belongs to (empty for main tools).
 *  - slug     Page slug created by the installer.
 *  - nav      Short label used in menus, chips and cards.
 *  - h1       Page heading.
 *  - title    SEO <title>.
 *  - desc     Meta description.
 *  - lead     Intro sentence under the heading.
 *  - config   Options passed to the app (preset values).
 *  - faqs     Question => answer pairs (also output as FAQPage schema).
 *  - related  Keys of sibling tools to cross-link.
 *  - content  Starter body copy inserted into the page on creation.
 *
 * @package Lumipix
 */

defined( 'ABSPATH' ) || exit;

/**
 * Tool groups (hubs).
 *
 * @return array<string, array<string, string>>
 */
function lumipix_tool_groups() {
	return apply_filters(
		'lumipix_tool_groups',
		array(
			'compress'   => array(
				'label' => __( 'Compress', 'lumipix' ),
				'desc'  => __( 'Shrink photos to an exact file size for forms, email and the web.', 'lumipix' ),
				'icon'  => 'compress',
			),
			'resize'     => array(
				'label' => __( 'Resize', 'lumipix' ),
				'desc'  => __( 'Change dimensions in pixels, centimetres or inches, with social presets.', 'lumipix' ),
				'icon'  => 'resize',
			),
			'background' => array(
				'label' => __( 'Background', 'lumipix' ),
				'desc'  => __( 'Remove or replace backgrounds with on-device AI.', 'lumipix' ),
				'icon'  => 'wand',
			),
		)
	);
}

/**
 * Full registry.
 *
 * @return array<string, array<string, mixed>>
 */
function lumipix_tools() {
	static $tools = null;
	if ( null !== $tools ) {
		return $tools;
	}

	$size_faqs = function ( $label ) {
		return array(
			/* translators: %s: target size, e.g. 100KB */
			sprintf( __( 'Will my photo be exactly %s?', 'lumipix' ), $label ) => sprintf(
				/* translators: %s: target size */
				__( 'It will be at or just under %s. The tool searches for the highest quality that still fits the limit, so you never upload a file that gets rejected for being a few bytes over.', 'lumipix' ),
				$label
			),
			__( 'Are my photos uploaded to a server?', 'lumipix' ) => __( 'No. Compression runs entirely inside your browser. Your files never leave your device, which also makes it fast on slow connections.', 'lumipix' ),
			__( 'What if the photo still looks too large?', 'lumipix' ) => __( 'If the quality setting alone cannot reach the target, Lumipix gently reduces the dimensions as well. You can also set a maximum width under Advanced options.', 'lumipix' ),
			__( 'Which formats are supported?', 'lumipix' ) => __( 'JPG, PNG, WebP, AVIF and most other formats your browser can open. The result is saved as JPG by default, which is accepted by almost every online form.', 'lumipix' ),
		);
	};

	$size_content = function ( $label, $use ) {
		return '<!-- wp:heading --><h2 class="wp-block-heading">' . sprintf( esc_html__( 'Why compress an image to %s?', 'lumipix' ), esc_html( $label ) ) . '</h2><!-- /wp:heading -->'
			. '<!-- wp:paragraph --><p>' . esc_html( $use ) . '</p><!-- /wp:paragraph -->'
			. '<!-- wp:heading --><h2 class="wp-block-heading">' . esc_html__( 'How the target-size compressor works', 'lumipix' ) . '</h2><!-- /wp:heading -->'
			. '<!-- wp:paragraph --><p>' . esc_html__( 'Most compressors ask you to guess a quality percentage. Lumipix works the other way round: you choose the file size you need and the tool tests different quality levels until it finds the sharpest version that fits. If quality alone is not enough, it reduces the dimensions in small steps, so text and faces stay readable.', 'lumipix' ) . '</p><!-- /wp:paragraph -->'
			. '<!-- wp:heading --><h2 class="wp-block-heading">' . esc_html__( 'Tips for the best result', 'lumipix' ) . '</h2><!-- /wp:heading -->'
			. '<!-- wp:list --><ul class="wp-block-list"><li>' . esc_html__( 'Start from the original photo, not a screenshot of it.', 'lumipix' ) . '</li><li>' . esc_html__( 'Crop away empty space first; fewer pixels means more quality per kilobyte.', 'lumipix' ) . '</li><li>' . esc_html__( 'Check the exact limit on the form you are filling in, then pick the matching size.', 'lumipix' ) . '</li></ul><!-- /wp:list -->';
	};

	$form_content = function ( $org ) {
		return '<!-- wp:heading --><h2 class="wp-block-heading">' . sprintf( esc_html__( 'Getting your photo ready for the %s application', 'lumipix' ), esc_html( $org ) ) . '</h2><!-- /wp:heading -->'
			. '<!-- wp:paragraph --><p>' . sprintf( esc_html__( 'Online application portals such as %s usually set a maximum file size and sometimes fixed dimensions for the photograph and signature. If your file is too large, the upload is rejected. Read the current instructions on the official advertisement or portal, note the limit, and choose it above.', 'lumipix' ), esc_html( $org ) ) . '</p><!-- /wp:paragraph -->'
			. '<!-- wp:heading --><h2 class="wp-block-heading">' . esc_html__( 'Step by step', 'lumipix' ) . '</h2><!-- /wp:heading -->'
			. '<!-- wp:list {"ordered":true} --><ol class="wp-block-list"><li>' . esc_html__( 'Take the photo against a plain, light background with even lighting.', 'lumipix' ) . '</li><li>' . esc_html__( 'Crop it so your face and shoulders fill most of the frame.', 'lumipix' ) . '</li><li>' . esc_html__( 'Drop it into the tool and choose the size limit from the official instructions.', 'lumipix' ) . '</li><li>' . esc_html__( 'Download the JPG and upload it to the portal.', 'lumipix' ) . '</li></ol><!-- /wp:list -->'
			. '<!-- wp:paragraph --><p>' . esc_html__( 'Lumipix is an independent tool and is not affiliated with any government department or testing service. Always follow the latest official requirements.', 'lumipix' ) . '</p><!-- /wp:paragraph -->';
	};

	$form_faqs = function ( $org ) {
		return array(
			/* translators: %s: organisation name */
			sprintf( __( 'What photo size does %s require?', 'lumipix' ), $org ) => __( 'Requirements change between advertisements, so always check the official instructions for the post you are applying for. Once you know the limit, select it here and the tool will produce a file that fits.', 'lumipix' ),
			__( 'Can I compress my signature too?', 'lumipix' ) => __( 'Yes. Use the same tool for the signature scan, or open the signature tool to make the background transparent or clean white first.', 'lumipix' ),
			__( 'Is it safe to use for official documents?', 'lumipix' ) => __( 'Your images are processed on your own device and are never uploaded to Lumipix, so nobody else sees them.', 'lumipix' ),
		);
	};

	$tools = array(

		/* ---------------------------------------------------------------
		 * Compress
		 * ------------------------------------------------------------- */
		'compress-image'             => array(
			'app'     => 'compress',
			'group'   => 'compress',
			'parent'  => '',
			'slug'    => 'compress-image',
			'icon'    => 'compress',
			'nav'     => __( 'Image Compressor', 'lumipix' ),
			'h1'      => __( 'Compress images to any size', 'lumipix' ),
			'title'   => __( 'Image Compressor – Compress to an Exact KB Size, Free & Private', 'lumipix' ),
			'desc'    => __( 'Compress JPG, PNG and WebP images to an exact size like 20KB, 50KB, 100KB or 200KB. Free, no signup, and your photos never leave your device.', 'lumipix' ),
			'lead'    => __( 'Pick a target size, drop your photos, and get the sharpest file that fits. Nothing is uploaded.', 'lumipix' ),
			'config'  => array( 'target' => 100, 'unit' => 'KB' ),
			'related' => array( 'image-resizer', 'compress-image-to-50kb', 'remove-white-background' ),
			'faqs'    => array(
				__( 'How do I compress an image to a specific size?', 'lumipix' ) => __( 'Type the size you need in KB or MB, or tap one of the quick sizes, then drop your image. Lumipix finds the best quality that fits under that limit automatically.', 'lumipix' ),
				__( 'Is this image compressor free?', 'lumipix' ) => __( 'Yes. There is no signup, no watermark and no daily limit.', 'lumipix' ),
				__( 'Are my photos uploaded?', 'lumipix' ) => __( 'No. Everything happens in your browser, so your files stay on your device.', 'lumipix' ),
				__( 'Can I compress several images at once?', 'lumipix' ) => __( 'Yes. Drop up to 20 images and each one is compressed to the same target.', 'lumipix' ),
			),
			'content' => $size_content( __( 'a specific size', 'lumipix' ), __( 'Job portals, university admissions, visa forms and email attachments all have file size limits. A compressor that targets an exact size saves you from trial and error: you get one file that is accepted the first time.', 'lumipix' ) ),
		),
		'compress-image-to-20kb'     => array(
			'app'     => 'compress',
			'group'   => 'compress',
			'parent'  => 'compress-image',
			'slug'    => 'compress-image-to-20kb',
			'icon'    => 'compress',
			'nav'     => __( 'Compress to 20KB', 'lumipix' ),
			'h1'      => __( 'Compress image to 20KB', 'lumipix' ),
			'title'   => __( 'Compress Image to 20KB Online – Free, No Signup', 'lumipix' ),
			'desc'    => __( 'Reduce any photo or signature to under 20KB in seconds. Ideal for online application forms. Free, private and works on mobile.', 'lumipix' ),
			'lead'    => __( 'Get a photo or signature under 20KB for strict upload limits, without blurring it beyond recognition.', 'lumipix' ),
			'config'  => array( 'target' => 20, 'unit' => 'KB', 'maxWidth' => 600 ),
			'related' => array( 'compress-image-to-50kb', 'resize-signature', 'passport-size-photo' ),
			'faqs'    => $size_faqs( '20KB' ),
			'content' => $size_content( '20KB', __( 'A 20KB limit is common for signatures and small profile photos on recruitment and admission portals. At this size, dimensions matter as much as quality, so the tool also limits the width to keep the result crisp.', 'lumipix' ) ),
		),
		'compress-image-to-50kb'     => array(
			'app'     => 'compress',
			'group'   => 'compress',
			'parent'  => 'compress-image',
			'slug'    => 'compress-image-to-50kb',
			'icon'    => 'compress',
			'nav'     => __( 'Compress to 50KB', 'lumipix' ),
			'h1'      => __( 'Compress image to 50KB', 'lumipix' ),
			'title'   => __( 'Compress Image to 50KB Online – Free JPG Compressor', 'lumipix' ),
			'desc'    => __( 'Compress JPG, PNG or WebP images to under 50KB while keeping them sharp. Free, no signup, and processed privately in your browser.', 'lumipix' ),
			'lead'    => __( 'Turn a heavy phone photo into a clean file under 50KB, ready for forms and profiles.', 'lumipix' ),
			'config'  => array( 'target' => 50, 'unit' => 'KB', 'maxWidth' => 1200 ),
			'related' => array( 'compress-image-to-20kb', 'compress-image-to-100kb', 'passport-size-photo' ),
			'faqs'    => $size_faqs( '50KB' ),
			'content' => $size_content( '50KB', __( 'Many online forms cap passport-style photographs at around 50KB. Modern phone photos are often 3–5MB, so they need to shrink by almost a hundred times without turning into a blurry mess.', 'lumipix' ) ),
		),
		'compress-image-to-100kb'    => array(
			'app'     => 'compress',
			'group'   => 'compress',
			'parent'  => 'compress-image',
			'slug'    => 'compress-image-to-100kb',
			'icon'    => 'compress',
			'nav'     => __( 'Compress to 100KB', 'lumipix' ),
			'h1'      => __( 'Compress image to 100KB', 'lumipix' ),
			'title'   => __( 'Compress Image to 100KB Online – Free, Fast & Private', 'lumipix' ),
			'desc'    => __( 'Compress photos to under 100KB without losing visible quality. Works with JPG, PNG and WebP, needs no signup, and never uploads your files.', 'lumipix' ),
			'lead'    => __( 'The most requested limit for forms and portals. Drop a photo and get a sharp JPG under 100KB.', 'lumipix' ),
			'config'  => array( 'target' => 100, 'unit' => 'KB', 'maxWidth' => 1600 ),
			'related' => array( 'compress-image-to-50kb', 'compress-image-to-200kb', 'image-resizer' ),
			'faqs'    => $size_faqs( '100KB' ),
			'content' => $size_content( '100KB', __( 'Exam boards, job portals and visa applications frequently accept images up to 100KB. It is enough room for a clear portrait or a readable document scan, as long as the compression is done carefully.', 'lumipix' ) ),
		),
		'compress-image-to-200kb'    => array(
			'app'     => 'compress',
			'group'   => 'compress',
			'parent'  => 'compress-image',
			'slug'    => 'compress-image-to-200kb',
			'icon'    => 'compress',
			'nav'     => __( 'Compress to 200KB', 'lumipix' ),
			'h1'      => __( 'Compress image to 200KB', 'lumipix' ),
			'title'   => __( 'Compress Image to 200KB Online – Free Image Compressor', 'lumipix' ),
			'desc'    => __( 'Reduce JPG, PNG and WebP images to under 200KB in one click. High quality, free, no signup, and fully private.', 'lumipix' ),
			'lead'    => __( 'Plenty of room for detail. Shrink large photos and scans to under 200KB for uploads and email.', 'lumipix' ),
			'config'  => array( 'target' => 200, 'unit' => 'KB', 'maxWidth' => 2000 ),
			'related' => array( 'compress-image-to-100kb', 'compress-image-to-1mb', 'image-resizer' ),
			'faqs'    => $size_faqs( '200KB' ),
			'content' => $size_content( '200KB', __( 'A 200KB limit is typical for document scans, CNIC or ID card copies and certificates on application portals. At this size text stays readable when the compression is tuned properly.', 'lumipix' ) ),
		),
		'compress-image-to-1mb'      => array(
			'app'     => 'compress',
			'group'   => 'compress',
			'parent'  => 'compress-image',
			'slug'    => 'compress-image-to-1mb',
			'icon'    => 'compress',
			'nav'     => __( 'Compress to 1MB', 'lumipix' ),
			'h1'      => __( 'Compress image to 1MB', 'lumipix' ),
			'title'   => __( 'Compress Image to 1MB Online – Keep Full Quality', 'lumipix' ),
			'desc'    => __( 'Bring large camera photos under 1MB with almost no visible difference. Free, private and no signup.', 'lumipix' ),
			'lead'    => __( 'Keep photos looking original while fitting them under a 1MB upload limit.', 'lumipix' ),
			'config'  => array( 'target' => 1, 'unit' => 'MB' ),
			'related' => array( 'compress-image-to-200kb', 'image-resizer', 'compress-image' ),
			'faqs'    => $size_faqs( '1MB' ),
			'content' => $size_content( '1MB', __( 'Websites, marketplaces and messaging apps often limit uploads to 1MB. High-resolution camera and phone photos easily exceed that, yet they can usually be brought under 1MB with no difference you can see.', 'lumipix' ) ),
		),
		'compress-photo-for-ppsc'    => array(
			'app'     => 'compress',
			'group'   => 'compress',
			'parent'  => 'compress-image',
			'slug'    => 'compress-photo-for-ppsc-form',
			'icon'    => 'file',
			'nav'     => __( 'Photo for PPSC form', 'lumipix' ),
			'h1'      => __( 'Compress photo for PPSC online form', 'lumipix' ),
			'title'   => __( 'Compress Photo for PPSC Online Application – Free', 'lumipix' ),
			'desc'    => __( 'Get your photograph and signature under the PPSC upload size limit in seconds. Free, private, and works on any phone.', 'lumipix' ),
			'lead'    => __( 'Check the size limit in your PPSC advertisement, select it below, and download a file that uploads first time.', 'lumipix' ),
			'config'  => array( 'target' => 50, 'unit' => 'KB', 'maxWidth' => 1000, 'quick' => array( 20, 30, 50, 100, 200 ) ),
			'related' => array( 'compress-photo-for-fpsc', 'compress-photo-for-nts', 'resize-signature' ),
			'faqs'    => $form_faqs( 'PPSC' ),
			'content' => $form_content( 'PPSC' ),
		),
		'compress-photo-for-fpsc'    => array(
			'app'     => 'compress',
			'group'   => 'compress',
			'parent'  => 'compress-image',
			'slug'    => 'compress-photo-for-fpsc-form',
			'icon'    => 'file',
			'nav'     => __( 'Photo for FPSC form', 'lumipix' ),
			'h1'      => __( 'Compress photo for FPSC online form', 'lumipix' ),
			'title'   => __( 'Compress Photo for FPSC Online Application – Free', 'lumipix' ),
			'desc'    => __( 'Resize and compress your photo and documents to the FPSC upload limit. Free, no signup, processed on your device.', 'lumipix' ),
			'lead'    => __( 'Choose the limit from the official FPSC instructions and get an upload-ready JPG in one step.', 'lumipix' ),
			'config'  => array( 'target' => 100, 'unit' => 'KB', 'maxWidth' => 1200, 'quick' => array( 20, 50, 100, 200, 500 ) ),
			'related' => array( 'compress-photo-for-ppsc', 'compress-photo-for-nts', 'compress-image-to-200kb' ),
			'faqs'    => $form_faqs( 'FPSC' ),
			'content' => $form_content( 'FPSC' ),
		),
		'compress-photo-for-nts'     => array(
			'app'     => 'compress',
			'group'   => 'compress',
			'parent'  => 'compress-image',
			'slug'    => 'compress-photo-for-nts-form',
			'icon'    => 'file',
			'nav'     => __( 'Photo for NTS form', 'lumipix' ),
			'h1'      => __( 'Compress photo for NTS online form', 'lumipix' ),
			'title'   => __( 'Compress Photo for NTS Online Registration – Free', 'lumipix' ),
			'desc'    => __( 'Make your photograph fit the NTS online registration upload limit. Free, private and works on mobile.', 'lumipix' ),
			'lead'    => __( 'Select the size from your NTS test instructions and download a photo that is ready to upload.', 'lumipix' ),
			'config'  => array( 'target' => 50, 'unit' => 'KB', 'maxWidth' => 1000, 'quick' => array( 20, 50, 100, 200 ) ),
			'related' => array( 'compress-photo-for-ppsc', 'compress-photo-for-fpsc', 'passport-size-photo' ),
			'faqs'    => $form_faqs( 'NTS' ),
			'content' => $form_content( 'NTS' ),
		),

		/* ---------------------------------------------------------------
		 * Resize
		 * ------------------------------------------------------------- */
		'image-resizer'              => array(
			'app'     => 'resize',
			'group'   => 'resize',
			'parent'  => '',
			'slug'    => 'image-resizer',
			'icon'    => 'resize',
			'nav'     => __( 'Image Resizer', 'lumipix' ),
			'h1'      => __( 'Resize images in pixels, cm or inches', 'lumipix' ),
			'title'   => __( 'Image Resizer – Resize Pictures in Pixels, CM or Inches, Free', 'lumipix' ),
			'desc'    => __( 'Resize JPG, PNG and WebP images by pixels, percentage, centimetres or inches. Batch resize, social presets, print DPI. Free and private.', 'lumipix' ),
			'lead'    => __( 'Exact dimensions, print sizes and social presets in one place. Your photos stay on your device.', 'lumipix' ),
			'config'  => array( 'width' => 1920, 'height' => 1080, 'unit' => 'px', 'presets' => array( 'hd', 'fhd', 'square', 'ig-post', 'ig-story', 'passport' ) ),
			'related' => array( 'resize-image-for-instagram', 'passport-size-photo', 'compress-image' ),
			'faqs'    => array(
				__( 'How do I resize an image to exact pixels?', 'lumipix' ) => __( 'Drop your image, type the width and height in pixels, and download. Keep the lock on to preserve the aspect ratio, or switch the fit mode to crop or pad to an exact size.', 'lumipix' ),
				__( 'Can I resize in centimetres or inches for printing?', 'lumipix' ) => __( 'Yes. Switch the unit to cm or in and set the DPI. Lumipix calculates the pixels and writes the DPI into the JPG so it prints at the right size.', 'lumipix' ),
				__( 'Can I resize many images at once?', 'lumipix' ) => __( 'Yes. Drop up to 20 images and they are all resized with the same settings.', 'lumipix' ),
				__( 'Does resizing reduce quality?', 'lumipix' ) => __( 'Making an image smaller keeps it sharp. Making it much larger than the original cannot add detail, so it may look soft.', 'lumipix' ),
			),
			'content' => '<!-- wp:heading --><h2 class="wp-block-heading">' . esc_html__( 'Resize for any purpose', 'lumipix' ) . '</h2><!-- /wp:heading --><!-- wp:paragraph --><p>' . esc_html__( 'Whether you need a 1920×1080 wallpaper, a 1080×1350 Instagram portrait, a 35×45 mm passport photo or a print at 300 DPI, the resizer handles it with one set of controls. Choose how the image should fit: keep the whole picture, crop to fill the frame, or add a background colour around it.', 'lumipix' ) . '</p><!-- /wp:paragraph --><!-- wp:heading --><h2 class="wp-block-heading">' . esc_html__( 'Pixels, centimetres, inches and DPI', 'lumipix' ) . '</h2><!-- /wp:heading --><!-- wp:paragraph --><p>' . esc_html__( 'Screens measure images in pixels, printers in centimetres or inches. The link between them is DPI (dots per inch). A 10 × 15 cm print at 300 DPI needs 1181 × 1772 pixels. Pick your unit and the resizer does the maths for you.', 'lumipix' ) . '</p><!-- /wp:paragraph -->',
		),
		'resize-image-for-instagram' => array(
			'app'     => 'resize',
			'group'   => 'resize',
			'parent'  => 'image-resizer',
			'slug'    => 'resize-image-for-instagram',
			'icon'    => 'instagram',
			'nav'     => __( 'Resize for Instagram', 'lumipix' ),
			'h1'      => __( 'Resize image for Instagram', 'lumipix' ),
			'title'   => __( 'Resize Image for Instagram – Post, Portrait & Story Sizes', 'lumipix' ),
			'desc'    => __( 'Resize photos for Instagram posts (1080×1080), portraits (1080×1350) and stories (1080×1920) without cropping important parts. Free and private.', 'lumipix' ),
			'lead'    => __( 'Square, portrait and story sizes in one tap. Fit the whole photo with a background, or crop to fill.', 'lumipix' ),
			'config'  => array( 'width' => 1080, 'height' => 1350, 'unit' => 'px', 'fit' => 'contain', 'presets' => array( 'ig-post', 'ig-portrait', 'ig-story', 'ig-landscape' ) ),
			'related' => array( 'image-resizer', 'compress-image', 'background-remover' ),
			'faqs'    => array(
				__( 'What is the best image size for Instagram?', 'lumipix' ) => __( 'Use 1080×1350 pixels (4:5) for portrait posts, 1080×1080 for square posts and 1080×1920 (9:16) for stories and reels covers.', 'lumipix' ),
				__( 'How do I post a full photo without Instagram cropping it?', 'lumipix' ) => __( 'Choose the Fit mode. The whole photo is placed inside the frame and the empty space is filled with a colour you pick, so nothing gets cut off.', 'lumipix' ),
				__( 'Will my photo lose quality?', 'lumipix' ) => __( 'The output is a high-quality JPG at the exact size Instagram displays, so the app does not need to recompress it heavily.', 'lumipix' ),
			),
			'content' => '<!-- wp:heading --><h2 class="wp-block-heading">' . esc_html__( 'Instagram image sizes at a glance', 'lumipix' ) . '</h2><!-- /wp:heading --><!-- wp:list --><ul class="wp-block-list"><li>' . esc_html__( 'Portrait post: 1080 × 1350 px (4:5) – takes up the most space in the feed.', 'lumipix' ) . '</li><li>' . esc_html__( 'Square post: 1080 × 1080 px (1:1).', 'lumipix' ) . '</li><li>' . esc_html__( 'Landscape post: 1080 × 566 px (1.91:1).', 'lumipix' ) . '</li><li>' . esc_html__( 'Story and reel cover: 1080 × 1920 px (9:16).', 'lumipix' ) . '</li></ul><!-- /wp:list --><!-- wp:paragraph --><p>' . esc_html__( 'Uploading at exactly these sizes means Instagram does less processing, which keeps your photos sharper in the feed.', 'lumipix' ) . '</p><!-- /wp:paragraph -->',
		),
		'passport-size-photo'        => array(
			'app'     => 'resize',
			'group'   => 'resize',
			'parent'  => 'image-resizer',
			'slug'    => 'passport-size-photo',
			'icon'    => 'user',
			'nav'     => __( 'Passport size photo', 'lumipix' ),
			'h1'      => __( 'Passport size photo maker', 'lumipix' ),
			'title'   => __( 'Passport Size Photo Maker – 35×45 mm at 300 DPI, Free', 'lumipix' ),
			'desc'    => __( 'Resize any photo to passport size (35×45 mm, 2×2 inch and more) at 300 DPI, ready to print or upload. Free and private.', 'lumipix' ),
			'lead'    => __( 'Crop and resize to standard passport and ID photo sizes, with the correct DPI for printing.', 'lumipix' ),
			'config'  => array( 'width' => 35, 'height' => 45, 'unit' => 'mm', 'dpi' => 300, 'fit' => 'cover', 'presets' => array( 'passport', 'us-passport', 'id-card' ) ),
			'related' => array( 'compress-image-to-50kb', 'background-remover', 'image-resizer' ),
			'faqs'    => array(
				__( 'What size is a passport photo?', 'lumipix' ) => __( 'Many countries use 35 × 45 mm. The United States and some others use 2 × 2 inches (51 × 51 mm). Always confirm the rules of the authority you are applying to.', 'lumipix' ),
				__( 'What DPI should a passport photo be?', 'lumipix' ) => __( '300 DPI is the usual print standard. At 300 DPI a 35 × 45 mm photo is 413 × 531 pixels.', 'lumipix' ),
				__( 'Does this check biometric rules?', 'lumipix' ) => __( 'No. The tool sets size and resolution. Make sure your face is centred, well lit and against a plain light background as required by the issuing authority.', 'lumipix' ),
			),
			'content' => '<!-- wp:heading --><h2 class="wp-block-heading">' . esc_html__( 'Make a passport photo at home', 'lumipix' ) . '</h2><!-- /wp:heading --><!-- wp:paragraph --><p>' . esc_html__( 'Stand in front of a plain light wall, face the camera directly and take the photo in daylight. Drop it into the tool, pick the size, and Lumipix crops it to the exact proportions at 300 DPI. Print it on photo paper or upload it to your online application.', 'lumipix' ) . '</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>' . esc_html__( 'Need a clean white background? Use the background remover first, then come back to resize.', 'lumipix' ) . '</p><!-- /wp:paragraph -->',
		),
		'resize-signature'           => array(
			'app'     => 'compress',
			'group'   => 'resize',
			'parent'  => 'image-resizer',
			'slug'    => 'resize-signature',
			'icon'    => 'pen',
			'nav'     => __( 'Signature resizer', 'lumipix' ),
			'h1'      => __( 'Resize signature for online forms', 'lumipix' ),
			'title'   => __( 'Resize Signature Online – Compress to 10KB or 20KB, Free', 'lumipix' ),
			'desc'    => __( 'Resize and compress a scanned signature to 10KB, 20KB or 50KB for online applications. Free, private and works on mobile.', 'lumipix' ),
			'lead'    => __( 'Snap your signature on white paper, drop it here, and get a small, clear file for the form.', 'lumipix' ),
			'config'  => array( 'target' => 20, 'unit' => 'KB', 'maxWidth' => 500, 'quick' => array( 10, 20, 30, 50 ) ),
			'related' => array( 'remove-white-background', 'compress-image-to-20kb', 'compress-photo-for-ppsc' ),
			'faqs'    => array(
				__( 'How do I make my signature smaller in KB?', 'lumipix' ) => __( 'Choose the size limit from the form instructions and drop your signature photo. The tool trims the dimensions and quality until it fits.', 'lumipix' ),
				__( 'How do I make a signature with a transparent background?', 'lumipix' ) => __( 'Use the white background remover. It turns the paper transparent and keeps the ink, and you can save it as PNG.', 'lumipix' ),
				__( 'What is the best way to photograph a signature?', 'lumipix' ) => __( 'Sign with a dark pen on plain white paper, take the photo in good light from directly above, and crop close to the signature.', 'lumipix' ),
			),
			'content' => '<!-- wp:heading --><h2 class="wp-block-heading">' . esc_html__( 'A clean signature in under a minute', 'lumipix' ) . '</h2><!-- /wp:heading --><!-- wp:paragraph --><p>' . esc_html__( 'Most application portals ask for a signature as a small JPG, often between 10KB and 50KB. Because a signature is mostly white space, it compresses very well when the photo is cropped tightly and the width is kept modest.', 'lumipix' ) . '</p><!-- /wp:paragraph -->',
		),

		/* ---------------------------------------------------------------
		 * Background
		 * ------------------------------------------------------------- */
		'background-remover'         => array(
			'app'     => 'bg',
			'group'   => 'background',
			'parent'  => '',
			'slug'    => 'background-remover',
			'icon'    => 'wand',
			'nav'     => __( 'Background Remover', 'lumipix' ),
			'h1'      => __( 'Remove background from image', 'lumipix' ),
			'title'   => __( 'Background Remover – Free HD Download, No Signup', 'lumipix' ),
			'desc'    => __( 'Remove the background from any photo with on-device AI. Download a full-resolution transparent PNG for free, without creating an account.', 'lumipix' ),
			'lead'    => __( 'Full-resolution transparent PNGs, free. The AI runs on your device, so your photos are never uploaded.', 'lumipix' ),
			'config'  => array(),
			'related' => array( 'remove-white-background', 'passport-size-photo', 'resize-image-for-instagram' ),
			'faqs'    => array(
				__( 'Is the HD download really free?', 'lumipix' ) => __( 'Yes. You download the result at the same resolution as your original, with no account and no watermark.', 'lumipix' ),
				__( 'Why does the first image take longer?', 'lumipix' ) => __( 'The AI model is downloaded to your browser once and then cached. After that, images are processed much faster, even offline.', 'lumipix' ),
				__( 'Are my photos uploaded?', 'lumipix' ) => __( 'No. The AI model runs inside your browser, so the image never leaves your device.', 'lumipix' ),
				__( 'Can I add a new background colour?', 'lumipix' ) => __( 'Yes. Keep it transparent or choose white or any colour before downloading.', 'lumipix' ),
			),
			'content' => '<!-- wp:heading --><h2 class="wp-block-heading">' . esc_html__( 'A free alternative to paid background removers', 'lumipix' ) . '</h2><!-- /wp:heading --><!-- wp:paragraph --><p>' . esc_html__( 'Many background removers give you a small preview for free and ask you to sign up or pay for the full-resolution file. Lumipix runs the AI model directly in your browser, so there is no server cost to pass on: you get the full-size PNG without an account.', 'lumipix' ) . '</p><!-- /wp:paragraph --><!-- wp:heading --><h2 class="wp-block-heading">' . esc_html__( 'Works best with', 'lumipix' ) . '</h2><!-- /wp:heading --><!-- wp:list --><ul class="wp-block-list"><li>' . esc_html__( 'Portraits and profile pictures', 'lumipix' ) . '</li><li>' . esc_html__( 'Product photos for online stores', 'lumipix' ) . '</li><li>' . esc_html__( 'Passport and ID photos that need a plain background', 'lumipix' ) . '</li></ul><!-- /wp:list --><!-- wp:paragraph --><p>' . esc_html__( 'For logos, signatures and scans on white paper, the white background remover is faster and gives crisper edges.', 'lumipix' ) . '</p><!-- /wp:paragraph -->',
		),
		'remove-white-background'    => array(
			'app'     => 'colorkey',
			'group'   => 'background',
			'parent'  => 'background-remover',
			'slug'    => 'remove-white-background',
			'icon'    => 'droplet',
			'nav'     => __( 'Remove white background', 'lumipix' ),
			'h1'      => __( 'Remove white background', 'lumipix' ),
			'title'   => __( 'Remove White Background from Image – Transparent PNG, Free', 'lumipix' ),
			'desc'    => __( 'Make the white background of logos, signatures and scans transparent in one click. Instant, free, no signup and fully private.', 'lumipix' ),
			'lead'    => __( 'Turn white or any solid colour transparent. Perfect for logos, signatures and stamps.', 'lumipix' ),
			'config'  => array( 'color' => '#ffffff', 'tolerance' => 18, 'feather' => 12 ),
			'related' => array( 'background-remover', 'resize-signature', 'compress-image' ),
			'faqs'    => array(
				__( 'How do I make a white background transparent?', 'lumipix' ) => __( 'Drop the image and the white areas become transparent instantly. Adjust tolerance if light grey shadows remain, then download the PNG.', 'lumipix' ),
				__( 'Can I remove a colour other than white?', 'lumipix' ) => __( 'Yes. Click anywhere on the preview to pick that colour, or choose one with the colour picker.', 'lumipix' ),
				__( 'Should I use this or the AI background remover?', 'lumipix' ) => __( 'Use this tool for flat backgrounds such as paper, logos and product shots on white. Use the AI remover for photos with busy backgrounds.', 'lumipix' ),
			),
			'content' => '<!-- wp:heading --><h2 class="wp-block-heading">' . esc_html__( 'Instant transparency for flat backgrounds', 'lumipix' ) . '</h2><!-- /wp:heading --><!-- wp:paragraph --><p>' . esc_html__( 'When the background is a single colour, you do not need AI. This tool measures how close each pixel is to the colour you pick and fades it out smoothly, keeping anti-aliased edges soft. It works instantly, even on large scans.', 'lumipix' ) . '</p><!-- /wp:paragraph -->',
		),
	);

	$tools = apply_filters( 'lumipix_tools', $tools );
	return $tools;
}

/**
 * Get a single tool definition.
 *
 * @param string $key Tool key.
 * @return array<string, mixed>|null
 */
function lumipix_get_tool( $key ) {
	$tools = lumipix_tools();
	return isset( $tools[ $key ] ) ? $tools[ $key ] : null;
}

/**
 * Tool key attached to a page, if any.
 *
 * @param int|null $post_id Post ID (defaults to the current post).
 * @return string
 */
function lumipix_page_tool_key( $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	if ( ! $post_id ) {
		return '';
	}
	$key = (string) get_post_meta( $post_id, '_lumipix_tool', true );
	return ( $key && lumipix_get_tool( $key ) ) ? $key : '';
}

/**
 * Find the published page that hosts a tool. Falls back to a page with the registry slug.
 *
 * @param string $key Tool key.
 * @return int Page ID or 0.
 */
function lumipix_tool_page_id( $key ) {
	static $cache = null;
	if ( null === $cache ) {
		$cache = array();
		$pages = get_posts(
			array(
				'post_type'      => 'page',
				'post_status'    => 'publish',
				'posts_per_page' => 200,
				'meta_key'       => '_lumipix_tool', // phpcs:ignore WordPress.DB.SlowDBQuery
				'fields'         => 'ids',
				'no_found_rows'  => true,
			)
		);
		foreach ( $pages as $page_id ) {
			$k = get_post_meta( $page_id, '_lumipix_tool', true );
			if ( $k && ! isset( $cache[ $k ] ) ) {
				$cache[ $k ] = (int) $page_id;
			}
		}
	}
	if ( isset( $cache[ $key ] ) ) {
		return $cache[ $key ];
	}
	$tool = lumipix_get_tool( $key );
	if ( $tool ) {
		$page = get_page_by_path( $tool['slug'] );
		if ( $page && 'publish' === $page->post_status ) {
			return (int) $page->ID;
		}
	}
	return 0;
}

/**
 * URL of a tool page (empty string if the page does not exist yet).
 *
 * @param string $key Tool key.
 * @return string
 */
function lumipix_tool_url( $key ) {
	$id = lumipix_tool_page_id( $key );
	return $id ? get_permalink( $id ) : '';
}

/**
 * Main tools (no parent), optionally limited to a group.
 *
 * @param string $group Group key.
 * @return array<string, array<string, mixed>>
 */
function lumipix_main_tools( $group = '' ) {
	return array_filter(
		lumipix_tools(),
		function ( $t ) use ( $group ) {
			return empty( $t['parent'] ) && ( ! $group || $t['group'] === $group );
		}
	);
}

/**
 * All tools in a group.
 *
 * @param string $group Group key.
 * @return array<string, array<string, mixed>>
 */
function lumipix_group_tools( $group ) {
	return array_filter(
		lumipix_tools(),
		function ( $t ) use ( $group ) {
			return $t['group'] === $group;
		}
	);
}

/**
 * Sibling presets of a tool (same parent family), excluding itself.
 *
 * @param string $key Tool key.
 * @return array<string, array<string, mixed>>
 */
function lumipix_tool_family( $key ) {
	$tool = lumipix_get_tool( $key );
	if ( ! $tool ) {
		return array();
	}
	$root = $tool['parent'] ? $tool['parent'] : $key;
	$out  = array();
	foreach ( lumipix_tools() as $k => $t ) {
		if ( $k === $root || $t['parent'] === $root ) {
			$out[ $k ] = $t;
		}
	}
	return $out;
}

/**
 * Resize presets (keys referenced from tool configs).
 *
 * @return array<string, array<string, mixed>>
 */
function lumipix_resize_presets() {
	return apply_filters(
		'lumipix_resize_presets',
		array(
			'hd'           => array( 'label' => 'HD 1280×720', 'w' => 1280, 'h' => 720, 'unit' => 'px' ),
			'fhd'          => array( 'label' => 'Full HD 1920×1080', 'w' => 1920, 'h' => 1080, 'unit' => 'px' ),
			'square'       => array( 'label' => 'Square 1080×1080', 'w' => 1080, 'h' => 1080, 'unit' => 'px' ),
			'ig-post'      => array( 'label' => 'Instagram post 1080×1080', 'w' => 1080, 'h' => 1080, 'unit' => 'px' ),
			'ig-portrait'  => array( 'label' => 'Instagram portrait 1080×1350', 'w' => 1080, 'h' => 1350, 'unit' => 'px' ),
			'ig-story'     => array( 'label' => 'Story 1080×1920', 'w' => 1080, 'h' => 1920, 'unit' => 'px' ),
			'ig-landscape' => array( 'label' => 'Landscape 1080×566', 'w' => 1080, 'h' => 566, 'unit' => 'px' ),
			'passport'     => array( 'label' => 'Passport 35×45 mm', 'w' => 35, 'h' => 45, 'unit' => 'mm', 'dpi' => 300 ),
			'us-passport'  => array( 'label' => 'US passport 2×2 in', 'w' => 2, 'h' => 2, 'unit' => 'in', 'dpi' => 300 ),
			'id-card'      => array( 'label' => 'ID photo 30×40 mm', 'w' => 30, 'h' => 40, 'unit' => 'mm', 'dpi' => 300 ),
		)
	);
}
