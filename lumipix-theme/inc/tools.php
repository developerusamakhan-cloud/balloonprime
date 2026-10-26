<?php
/**
 * Tool registry.
 *
 * Every tool landing page (main tools and their presets) is described here.
 * Pages are linked to an entry through the `_lumipix_tool` post meta, which
 * the installer sets automatically and editors can change in the page sidebar.
 *
 * Keys:
 *  - app      Which in-browser app to mount: compress | resize | bg | colorkey | convert | pdf | favicon | dpi | crop
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
			'convert'    => array(
				'label' => __( 'Convert', 'lumipix' ),
				'desc'  => __( 'Change formats: WebP, AVIF, PNG, JPG, SVG and PDF.', 'lumipix' ),
				'icon'  => 'convert',
			),
			'background' => array(
				'label' => __( 'Background', 'lumipix' ),
				'desc'  => __( 'Remove or replace backgrounds with on-device AI.', 'lumipix' ),
				'icon'  => 'wand',
			),
			'more'       => array(
				'label' => __( 'More tools', 'lumipix' ),
				'desc'  => __( 'Favicons, DPI and cropping.', 'lumipix' ),
				'icon'  => 'grid',
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


	$size_content = function ( $label, $use ) {
		return '<!-- wp:heading --><h2 class="wp-block-heading">' . sprintf( esc_html__( 'Why compress an image to %s?', 'lumipix' ), esc_html( $label ) ) . '</h2><!-- /wp:heading -->'
			. '<!-- wp:paragraph --><p>' . esc_html( $use ) . '</p><!-- /wp:paragraph -->'
			. '<!-- wp:heading --><h2 class="wp-block-heading">' . esc_html__( 'How the target-size compressor works', 'lumipix' ) . '</h2><!-- /wp:heading -->'
			. '<!-- wp:paragraph --><p>' . esc_html__( 'Most compressors ask you to guess a quality percentage. Lumi Pix works the other way round: you choose the file size you need and the tool tests different quality levels until it finds the sharpest version that fits. If quality alone is not enough, it reduces the dimensions in small steps, so text and faces stay readable.', 'lumipix' ) . '</p><!-- /wp:paragraph -->'
			. '<!-- wp:heading --><h2 class="wp-block-heading">' . esc_html__( 'Tips for the best result', 'lumipix' ) . '</h2><!-- /wp:heading -->'
			. '<!-- wp:list --><ul class="wp-block-list"><li>' . esc_html__( 'Start from the original photo, not a screenshot of it.', 'lumipix' ) . '</li><li>' . esc_html__( 'Crop away empty space first; fewer pixels means more quality per kilobyte.', 'lumipix' ) . '</li><li>' . esc_html__( 'Check the exact limit on the form you are filling in, then pick the matching size.', 'lumipix' ) . '</li></ul><!-- /wp:list -->';
	};

	$form_content = function ( $org ) {
		return '<!-- wp:heading --><h2 class="wp-block-heading">' . sprintf( esc_html__( 'Getting your photo ready for the %s application', 'lumipix' ), esc_html( $org ) ) . '</h2><!-- /wp:heading -->'
			. '<!-- wp:paragraph --><p>' . sprintf( esc_html__( 'Online application portals such as %s usually set a maximum file size and sometimes fixed dimensions for the photograph and signature. If your file is too large, the upload is rejected. Read the current instructions on the official advertisement or portal, note the limit, and choose it above.', 'lumipix' ), esc_html( $org ) ) . '</p><!-- /wp:paragraph -->'
			. '<!-- wp:heading --><h2 class="wp-block-heading">' . esc_html__( 'Step by step', 'lumipix' ) . '</h2><!-- /wp:heading -->'
			. '<!-- wp:list {"ordered":true} --><ol class="wp-block-list"><li>' . esc_html__( 'Take the photo against a plain, light background with even lighting.', 'lumipix' ) . '</li><li>' . esc_html__( 'Crop it so your face and shoulders fill most of the frame.', 'lumipix' ) . '</li><li>' . esc_html__( 'Drop it into the tool and choose the size limit from the official instructions.', 'lumipix' ) . '</li><li>' . esc_html__( 'Download the JPG and upload it to the portal.', 'lumipix' ) . '</li></ol><!-- /wp:list -->'
			. '<!-- wp:paragraph --><p>' . esc_html__( 'Lumi Pix is an independent tool and is not affiliated with any government department or testing service. Always follow the latest official requirements.', 'lumipix' ) . '</p><!-- /wp:paragraph -->';
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
			'h1'      => __( 'Reduce image size in KB online', 'lumipix' ),
			'title'   => __( 'Reduce Image Size in KB Online: Free Image Compressor', 'lumipix' ),
			'desc'    => __( 'Compress JPG, PNG and WebP images to an exact size like 20KB, 50KB, 100KB or 200KB. Free, no signup, and your photos never leave your device.', 'lumipix' ),
			'lead'    => __( 'Pick a target size, drop your photos, and get the sharpest file that fits. Nothing is uploaded.', 'lumipix' ),
			'config'  => array( 'target' => 100, 'unit' => 'KB' ),
			'related' => array( 'image-resizer', 'compress-image-to-50kb', 'remove-white-background' ),
			'faqs'    => array(
				__( 'How do I compress an image to a specific size?', 'lumipix' ) => __( 'Type the size you need in KB or MB, or tap one of the quick sizes, then drop your image. Lumi Pix finds the best quality that fits under that limit automatically.', 'lumipix' ),
				__( 'Is this image compressor free?', 'lumipix' ) => __( 'Yes. There is no signup, no watermark and no daily limit.', 'lumipix' ),
				__( 'Are my photos uploaded?', 'lumipix' ) => __( 'No. Everything happens in your browser, so your files stay on your device.', 'lumipix' ),
				__( 'Can I compress several images at once?', 'lumipix' ) => __( 'Yes. Drop up to 20 images and each one is compressed to the same target.', 'lumipix' ),
			),
			'content' => $size_content( __( 'a specific size', 'lumipix' ), __( 'Job portals, university admissions, visa forms and email attachments all have file size limits. A compressor that targets an exact size saves you from trial and error: you get one file that is accepted the first time.', 'lumipix' ) ),
		),
		'compress-image-to-10kb'     => array(
			'app'     => 'compress',
			'group'   => 'compress',
			'parent'  => 'compress-image',
			'slug'    => 'compress-image-to-10kb',
			'icon'    => 'feather',
			'nav'     => __( 'Compress to 10KB', 'lumipix' ),
			'h1'      => __( 'Compress image to 10KB', 'lumipix' ),
			'title'   => __( 'Compress Image to 10KB Online: Signatures & Small Photos', 'lumipix' ),
			'desc'    => __( 'Get a signature or small photo under 10KB while keeping it readable. Free, private and works on mobile, nothing is uploaded.', 'lumipix' ),
			'lead'    => __( 'The strictest common limit. Ideal for signatures and thumbnails on online application forms.', 'lumipix' ),
			'config'  => array( 'target' => 10, 'unit' => 'KB', 'maxWidth' => 400, 'quick' => array( 5, 10, 15, 20 ) ),
			'related' => array( 'resize-signature', 'compress-image-to-20kb', 'remove-white-background' ),
			'faqs'    => array(
				__( 'Will a 10KB photo still be clear?', 'lumipix' ) => __( 'For a small passport-style photo or a signature, yes. Forms show these images small, so a 10KB file looks clean on screen. A wide group photo loses detail at this size, so crop to the face or the signature first.', 'lumipix' ),
				__( 'How do I get a signature under 10KB?', 'lumipix' ) => __( 'Sign on plain white paper, scan or photograph it in good light, crop tightly around the signature and drop it here. Dark ink on white compresses very well, so most signatures fit in 10KB and stay readable.', 'lumipix' ),
				__( 'Why did the tool make my picture smaller in pixels?', 'lumipix' ) => __( 'At 10KB, lowering the JPG quality alone is often not enough. Lumi Pix then reduces the dimensions step by step and keeps the sharpest version that stays at or under 10KB.', 'lumipix' ),
				__( 'Is it safe to use for ID photos and signatures?', 'lumipix' ) => __( 'Yes. The file is processed in your browser and never uploaded, so nobody else sees your photo or signature.', 'lumipix' ),
			),
			'content' => $size_content( '10KB', __( 'A 10KB limit is mostly used for signatures and tiny thumbnails. At this size the image must be small in pixels as well as compressed, so the tool limits the width automatically.', 'lumipix' ) ),
		),
		'compress-image-to-20kb'     => array(
			'app'     => 'compress',
			'group'   => 'compress',
			'parent'  => 'compress-image',
			'slug'    => 'compress-image-to-20kb',
			'icon'    => 'compress',
			'nav'     => __( 'Compress to 20KB', 'lumipix' ),
			'h1'      => __( 'Resize image to 20KB', 'lumipix' ),
			'title'   => __( 'Resize Image to 20KB Online: Compress Photo to 20KB, Free', 'lumipix' ),
			'desc'    => __( 'Reduce any photo or signature to under 20KB in seconds. Ideal for online application forms. Free, private and works on mobile.', 'lumipix' ),
			'lead'    => __( 'Get a photo or signature under 20KB for strict upload limits, without blurring it beyond recognition.', 'lumipix' ),
			'config'  => array( 'target' => 20, 'unit' => 'KB', 'maxWidth' => 600 ),
			'related' => array( 'compress-image-to-50kb', 'resize-signature', 'passport-size-photo' ),
			'faqs'    => array(
				__( 'Is 20KB enough for a passport-style photo?', 'lumipix' ) => __( 'Usually yes. Online forms display these photos small, and a head-and-shoulders photo at that size fits in 20KB as a JPG with clear facial detail.', 'lumipix' ),
				__( 'Can I compress my photo and signature to 20KB together?', 'lumipix' ) => __( 'Yes. Drop both files at once. Each one is compressed separately to stay under 20KB, and you can download them one by one or together as a ZIP.', 'lumipix' ),
				__( 'My form says between 10KB and 20KB. What should I pick?', 'lumipix' ) => __( 'Pick 20KB. The result lands just under the maximum, which keeps the most detail while staying inside the range. If your original is already smaller than 10KB, make it larger in pixels with the image resizer first.', 'lumipix' ),
				__( 'Which format will the 20KB file be?', 'lumipix' ) => __( 'JPG by default, which almost every application form accepts. Transparent areas in a PNG become white, as JPG has no transparency.', 'lumipix' ),
			),
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
			'title'   => __( 'Compress Image to 50 KB Online: Free JPG Compressor', 'lumipix' ),
			'desc'    => __( 'Compress JPG, PNG or WebP images to under 50KB while keeping them sharp. Free, no signup, and processed privately in your browser.', 'lumipix' ),
			'lead'    => __( 'Turn a heavy phone photo into a clean file under 50KB, ready for forms and profiles.', 'lumipix' ),
			'config'  => array( 'target' => 50, 'unit' => 'KB', 'maxWidth' => 1200 ),
			'related' => array( 'compress-image-to-20kb', 'compress-image-to-100kb', 'passport-size-photo' ),
			'faqs'    => array(
				__( 'Why does my large phone photo still look sharp at 50KB?', 'lumipix' ) => __( 'Most of a phone photo\'s file size comes from its very high pixel count. Forms show photos small, so Lumi Pix reduces the pixels to a sensible size when needed and the face stays sharp while the file drops to 50KB.', 'lumipix' ),
				__( 'Can I also limit the width and height?', 'lumipix' ) => __( 'Yes. Open Advanced options and set a maximum width. This helps when a form limits the dimensions as well as the file size.', 'lumipix' ),
				__( 'Will the colours or background change?', 'lumipix' ) => __( 'No. Compression keeps the colours as they are. Only transparent areas of a PNG turn white, because JPG has no transparency.', 'lumipix' ),
				__( 'Can I compress several photos to 50KB at once?', 'lumipix' ) => __( 'Yes, up to 20 photos in one batch. Each file is compressed on its own and you can download them all as a ZIP.', 'lumipix' ),
			),
			'content' => $size_content( '50KB', __( 'Many online forms cap passport-style photographs at around 50KB. Modern phone photos are often 3 to 5MB, so they need to shrink by almost a hundred times without turning into a blurry mess.', 'lumipix' ) ),
		),
		'compress-image-to-100kb'    => array(
			'app'     => 'compress',
			'group'   => 'compress',
			'parent'  => 'compress-image',
			'slug'    => 'compress-image-to-100kb',
			'icon'    => 'compress',
			'nav'     => __( 'Compress to 100KB', 'lumipix' ),
			'h1'      => __( 'Compress image to 100KB', 'lumipix' ),
			'title'   => __( 'Compress Image to 100 KB Online: Free, Fast and Private', 'lumipix' ),
			'desc'    => __( 'Compress photos to under 100KB without losing visible quality. Works with JPG, PNG and WebP, needs no signup, and never uploads your files.', 'lumipix' ),
			'lead'    => __( 'The most requested limit for forms and portals. Drop a photo and get a sharp JPG under 100KB.', 'lumipix' ),
			'config'  => array( 'target' => 100, 'unit' => 'KB', 'maxWidth' => 1600 ),
			'related' => array( 'compress-image-to-50kb', 'compress-image-to-200kb', 'image-resizer' ),
			'faqs'    => array(
				__( 'Why is the result 96KB and not exactly 100KB?', 'lumipix' ) => __( 'The tool looks for the highest quality that stays at or under the limit. JPG sizes change in small steps, so the result usually lands a little below 100KB, which every form accepts.', 'lumipix' ),
				__( 'Is a 100KB photo good enough to print?', 'lumipix' ) => __( 'For a small print such as a passport photo it often is. For larger prints keep the original file, because 100KB is meant for uploads and email rather than printing.', 'lumipix' ),
				__( 'Does it work with iPhone and Android photos?', 'lumipix' ) => __( 'Yes. Choose the photo from your gallery in the browser and compress it right on the phone. Nothing is uploaded.', 'lumipix' ),
				__( 'How many photos can I compress to 100KB at a time?', 'lumipix' ) => __( 'Up to 20. They are all compressed with the same target and you can download them together as a ZIP file.', 'lumipix' ),
			),
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
			'title'   => __( 'Compress Image to 200KB Online: Free Image Compressor', 'lumipix' ),
			'desc'    => __( 'Reduce JPG, PNG and WebP images to under 200KB in one click. High quality, free, no signup, and fully private.', 'lumipix' ),
			'lead'    => __( 'Plenty of room for detail. Shrink large photos and scans to under 200KB for uploads and email.', 'lumipix' ),
			'config'  => array( 'target' => 200, 'unit' => 'KB', 'maxWidth' => 2000 ),
			'related' => array( 'compress-image-to-100kb', 'compress-image-to-1mb', 'image-resizer' ),
			'faqs'    => array(
				__( 'Can I compress a scanned document to 200KB?', 'lumipix' ) => __( 'Yes. Scans of certificates, ID cards and letters usually stay clearly readable at 200KB. For the best result, scan at 150 to 300 DPI and crop away empty borders first.', 'lumipix' ),
				__( 'Will text in a screenshot stay readable?', 'lumipix' ) => __( 'In most cases, yes. If a screenshot with small text looks soft, crop it to the important part before compressing, so more of the 200KB goes to the text.', 'lumipix' ),
				__( 'Where is a 200KB limit common?', 'lumipix' ) => __( 'Job portals, university admissions, visa and exam forms often limit photos or scanned documents to around 200KB. Always check the exact limit in your form\'s instructions.', 'lumipix' ),
				__( 'Can I combine several 200KB scans into one file?', 'lumipix' ) => __( 'Yes. Compress each page here, then join them with the image to PDF tool in the order you need.', 'lumipix' ),
			),
			'content' => $size_content( '200KB', __( 'A 200KB limit is typical for document scans, CNIC or ID card copies and certificates on application portals. At this size text stays readable when the compression is tuned properly.', 'lumipix' ) ),
		),
		'compress-image-to-500kb'    => array(
			'app'     => 'compress',
			'group'   => 'compress',
			'parent'  => 'compress-image',
			'slug'    => 'compress-image-to-500kb',
			'icon'    => 'compress',
			'nav'     => __( 'Compress to 500KB', 'lumipix' ),
			'h1'      => __( 'Compress image to 500KB', 'lumipix' ),
			'title'   => __( 'Compress Image to 500KB Online: High Quality, Free', 'lumipix' ),
			'desc'    => __( 'Reduce photos and scans to under 500KB with excellent quality for websites, email and multi-page documents. Free, private and no signup.', 'lumipix' ),
			'lead'    => __( 'Plenty of room for detail. Great for website images, email and high-quality document scans.', 'lumipix' ),
			'config'  => array( 'target' => 500, 'unit' => 'KB', 'quick' => array( 200, 300, 500, 800 ) ),
			'related' => array( 'compress-image-to-200kb', 'compress-image-to-1mb', 'image-resizer' ),
			'faqs'    => array(
				__( 'Does a 500KB photo look as good as the original?', 'lumipix' ) => __( 'On a phone or computer screen, almost always. 500KB leaves plenty of room for a sharp, full HD sized photo, so the difference is very hard to see.', 'lumipix' ),
				__( 'Is 500KB a good size for website images?', 'lumipix' ) => __( 'It is a good upper limit for large banner or hero images. For thumbnails and images inside articles, smaller files of 100KB to 200KB load faster.', 'lumipix' ),
				__( 'How do I send several pages under 500KB each?', 'lumipix' ) => __( 'Compress every page to 500KB here, then combine them with the image to PDF tool if the form wants a single document.', 'lumipix' ),
				__( 'Why not just lower the quality in my photo editor?', 'lumipix' ) => __( 'An editor makes you guess the quality, save, check and try again. Here you choose 500KB once and the tool finds the best quality that fits in one step.', 'lumipix' ),
			),
			'content' => $size_content( '500KB', __( 'Half a megabyte is generous: a full-resolution phone photo usually fits with almost no visible change, and detailed document scans stay sharp.', 'lumipix' ) ),
		),
		'compress-image-to-1mb'      => array(
			'app'     => 'compress',
			'group'   => 'compress',
			'parent'  => 'compress-image',
			'slug'    => 'compress-image-to-1mb',
			'icon'    => 'compress',
			'nav'     => __( 'Compress to 1MB', 'lumipix' ),
			'h1'      => __( 'Compress image to 1MB', 'lumipix' ),
			'title'   => __( 'Compress Image to 1MB Online: Keep Full Quality', 'lumipix' ),
			'desc'    => __( 'Bring large camera photos under 1MB with almost no visible difference. Free, private and no signup.', 'lumipix' ),
			'lead'    => __( 'Keep photos looking original while fitting them under a 1MB upload limit.', 'lumipix' ),
			'config'  => array( 'target' => 1, 'unit' => 'MB' ),
			'related' => array( 'compress-image-to-200kb', 'image-resizer', 'compress-image' ),
			'faqs'    => array(
				__( 'Will a 1MB photo look different from the original?', 'lumipix' ) => __( 'Almost never on screen. 1MB is enough for a high quality JPG at a large size, so most photos look the same as before.', 'lumipix' ),
				__( 'Is 1MB a good size for email?', 'lumipix' ) => __( 'Yes. Several 1MB photos fit comfortably in one email, while large camera originals often go over the attachment limit.', 'lumipix' ),
				__( 'Can I still print a photo compressed to 1MB?', 'lumipix' ) => __( 'Standard photo prints such as 10 × 15 cm or 4 × 6 in usually look fine. For large prints, keep and use the original file.', 'lumipix' ),
				__( 'Is camera information kept in the file?', 'lumipix' ) => __( 'Not when the photo is compressed. It is re-encoded in your browser, which removes camera metadata such as GPS location. A JPG that is already under 1MB is kept exactly as it is, metadata included.', 'lumipix' ),
			),
			'content' => $size_content( '1MB', __( 'Websites, marketplaces and messaging apps often limit uploads to 1MB. High-resolution camera and phone photos easily exceed that, yet they can usually be brought under 1MB with no difference you can see.', 'lumipix' ) ),
		),
		'compress-image-to-2mb'      => array(
			'app'     => 'compress',
			'group'   => 'compress',
			'parent'  => 'compress-image',
			'slug'    => 'compress-image-to-2mb',
			'icon'    => 'compress',
			'nav'     => __( 'Compress to 2MB', 'lumipix' ),
			'h1'      => __( 'Compress image to 2MB', 'lumipix' ),
			'title'   => __( 'Compress Image to 2 MB Online: Near Original Quality, Free', 'lumipix' ),
			'desc'    => __( 'Bring large camera and phone photos under 2MB with near-original quality. Ideal for uploads, printing services and sharing. Free and private.', 'lumipix' ),
			'lead'    => __( 'Keep almost every detail while getting big camera files under a 2MB upload limit.', 'lumipix' ),
			'config'  => array( 'target' => 2, 'unit' => 'MB', 'quick' => array( 500, 1000, 1500, 2000 ) ),
			'related' => array( 'compress-image-to-5mb', 'compress-image-to-1mb', 'compress-image-to-500kb' ),
			'faqs'    => array(
				__( 'Will my photo keep its full resolution at 2MB?', 'lumipix' ) => __( 'Often it will, or it is reduced only slightly. The tool lowers quality first and only reduces the pixel size if that is needed to fit under 2MB.', 'lumipix' ),
				__( 'Is 2MB enough for printing?', 'lumipix' ) => __( 'For standard photo prints, yes. A 2MB JPG has enough detail for common print sizes. Keep the original for posters or large wall prints.', 'lumipix' ),
				__( 'Which services limit uploads to 2MB?', 'lumipix' ) => __( 'Many job portals, university forms, support desks and print shops set a 2MB limit. Check the exact number in their instructions before you upload.', 'lumipix' ),
				__( 'Can I compress many camera photos to 2MB at once?', 'lumipix' ) => __( 'Yes. Add up to 20 photos, and download them one by one or all together as a ZIP file.', 'lumipix' ),
			),
			'content' => $size_content( '2MB', __( 'Many upload forms, print services and help desks limit images to 2MB. Camera and high-end phone photos are often larger, but they can be brought under 2MB with no difference you would notice.', 'lumipix' ) ),
		),
		'compress-image-to-5mb'      => array(
			'app'     => 'compress',
			'group'   => 'compress',
			'parent'  => 'compress-image',
			'slug'    => 'compress-image-to-5mb',
			'icon'    => 'compress',
			'nav'     => __( 'Compress to 5MB', 'lumipix' ),
			'h1'      => __( 'Compress image to 5MB', 'lumipix' ),
			'title'   => __( 'Compress Image to 5MB Online: Full Quality, Free', 'lumipix' ),
			'desc'    => __( 'Compress image to 5MB online and keep full visible quality. Shrink large camera, phone and scanned images under a 5MB upload limit. Free, private, no signup.', 'lumipix' ),
			'lead'    => __( 'Get large camera photos and scans under a 5MB upload limit with no visible change.', 'lumipix' ),
			'config'  => array( 'target' => 5, 'unit' => 'MB', 'quick' => array( 1000, 2000, 3000, 5000 ) ),
			'related' => array( 'compress-image-to-2mb', 'compress-image-to-1mb', 'image-resizer' ),
			'faqs'    => array(
				__( 'Will compressing to 5MB reduce the quality?', 'lumipix' ) => __( 'Very rarely in a way you can see. Most camera and phone photos need only light compression to fit in 5MB, so they look the same as the original.', 'lumipix' ),
				__( 'Can I compress RAW or HEIC files to 5MB?', 'lumipix' ) => __( 'The tool works with formats your browser can open, such as JPG, PNG, WebP and AVIF. Convert RAW files to JPG in your camera software first.', 'lumipix' ),
				__( 'Is a 5MB photo good for printing?', 'lumipix' ) => __( 'Yes, for most print sizes. For very large posters, keep the original file and use the 5MB copy for uploads.', 'lumipix' ),
				__( 'What about panoramas and very large images?', 'lumipix' ) => __( 'They work too. If a very large image cannot fit in 5MB at good quality, its dimensions are reduced slightly so the file fits.', 'lumipix' ),
			),
			'content' => $size_content( '5MB', __( 'Many websites, job portals and email services limit attachments to 5MB. Photos from modern cameras and phones, and high-resolution scans, can be much larger, but bringing them under 5MB rarely needs any visible loss of quality.', 'lumipix' ) ),
		),
		'compress-photo-for-ppsc'    => array(
			'app'     => 'compress',
			'group'   => 'compress',
			'parent'  => 'compress-image',
			'slug'    => 'compress-photo-for-ppsc-form',
			'icon'    => 'file',
			'nav'     => __( 'Photo for PPSC form', 'lumipix' ),
			'h1'      => __( 'Compress photo for PPSC online form', 'lumipix' ),
			'title'   => __( 'Compress Photo for PPSC Online Application: Free', 'lumipix' ),
			'desc'    => __( 'Get your photograph and signature under the PPSC upload size limit in seconds. Free, private, and works on any phone.', 'lumipix' ),
			'lead'    => __( 'Check the size limit in your PPSC advertisement, select it below, and download a file that uploads first time.', 'lumipix' ),
			'config'  => array( 'target' => 50, 'unit' => 'KB', 'maxWidth' => 1000, 'quick' => array( 20, 30, 50, 100, 200 ) ),
			'related' => array( 'compress-photo-for-fpsc', 'compress-photo-for-nts', 'resize-signature' ),
			'faqs'    => array(
				__( 'Where do I find the PPSC photo and signature limits?', 'lumipix' ) => __( 'In the instructions of the advertisement and on the online application form on the PPSC website. Limits can differ between posts, so check them for the job you are applying for.', 'lumipix' ),
				__( 'Why does the PPSC portal reject my photo?', 'lumipix' ) => __( 'Most often the file is larger than the allowed size, in a format the portal does not accept, or too dark. Compress it here to the stated limit as a JPG and try again.', 'lumipix' ),
				__( 'Can I prepare my PPSC photo on my phone?', 'lumipix' ) => __( 'Yes. Take the photo against a plain, light wall in daylight, then open this page in your phone browser, choose the limit and download the result.', 'lumipix' ),
			),
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
			'title'   => __( 'Compress Photo for FPSC Online Application: Free', 'lumipix' ),
			'desc'    => __( 'Resize and compress your photo and documents to the FPSC upload limit. Free, no signup, processed on your device.', 'lumipix' ),
			'lead'    => __( 'Choose the limit from the official FPSC instructions and get an upload-ready JPG in one step.', 'lumipix' ),
			'config'  => array( 'target' => 100, 'unit' => 'KB', 'maxWidth' => 1200, 'quick' => array( 20, 50, 100, 200, 500 ) ),
			'related' => array( 'compress-photo-for-ppsc', 'compress-photo-for-nts', 'compress-image-to-200kb' ),
			'faqs'    => array(
				__( 'What files does the FPSC online application ask for?', 'lumipix' ) => __( 'That depends on the post. The advertisement and the online form list the photo and documents required and their size limits, so read them before preparing your files.', 'lumipix' ),
				__( 'How do I make a scanned certificate small enough for FPSC?', 'lumipix' ) => __( 'Drop the scan here and choose the limit from the instructions. If the form wants several pages in one file, compress each page and combine them with the image to PDF tool.', 'lumipix' ),
				__( 'Will compressing my photo make my face blurry?', 'lumipix' ) => __( 'No. The tool keeps the highest quality that still fits the limit, so your face stays clear at the sizes application forms use.', 'lumipix' ),
			),
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
			'title'   => __( 'Compress Photo for NTS Online Registration: Free', 'lumipix' ),
			'desc'    => __( 'Make your photograph fit the NTS online registration upload limit. Free, private and works on mobile.', 'lumipix' ),
			'lead'    => __( 'Select the size from your NTS test instructions and download a photo that is ready to upload.', 'lumipix' ),
			'config'  => array( 'target' => 50, 'unit' => 'KB', 'maxWidth' => 1000, 'quick' => array( 20, 50, 100, 200 ) ),
			'related' => array( 'compress-photo-for-ppsc', 'compress-photo-for-fpsc', 'passport-size-photo' ),
			'faqs'    => array(
				__( 'Where are the NTS photo requirements?', 'lumipix' ) => __( 'In the instructions for your specific test on the NTS website and in the registration form. Requirements can differ between tests, so check them each time.', 'lumipix' ),
				__( 'Can I use a mobile selfie for NTS registration?', 'lumipix' ) => __( 'It is better to ask someone to take the photo from about 1.5 metres away, against a plain light background. Then crop it to your face and shoulders and compress it here.', 'lumipix' ),
				__( 'What if my photo is already under the limit?', 'lumipix' ) => __( 'Then you can upload it as it is. Lumi Pix only reduces files that are larger than the size you choose.', 'lumipix' ),
			),
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
			'h1'      => __( 'Resize image by size in pixels, cm or inches', 'lumipix' ),
			'title'   => __( 'Resize Image by Size: Pixels, CM or Inches, Free Online', 'lumipix' ),
			'desc'    => __( 'Resize JPG, PNG and WebP images by pixels, percentage, centimetres or inches. Batch resize, social presets, print DPI. Free and private.', 'lumipix' ),
			'lead'    => __( 'Exact dimensions, print sizes and social presets in one place. Your photos stay on your device.', 'lumipix' ),
			'config'  => array( 'width' => 1920, 'height' => 1080, 'unit' => 'px', 'presets' => array( 'hd', 'fhd', 'square', 'ig-post', 'ig-story', 'passport' ) ),
			'related' => array( 'resize-image-in-bulk', 'resize-image-for-instagram', 'passport-size-photo' ),
			'faqs'    => array(
				__( 'How do I resize an image to exact pixels?', 'lumipix' ) => __( 'Drop your image, type the width and height in pixels, and download. Keep the lock on to preserve the aspect ratio, or switch the fit mode to crop or pad to an exact size.', 'lumipix' ),
				__( 'Can I resize in centimetres or inches for printing?', 'lumipix' ) => __( 'Yes. Switch the unit to cm or in and set the DPI. Lumi Pix calculates the pixels and writes the DPI into the JPG so it prints at the right size.', 'lumipix' ),
				__( 'Can I resize many images at once?', 'lumipix' ) => __( 'Yes. Drop up to 20 images and they are all resized with the same settings.', 'lumipix' ),
				__( 'Does resizing reduce quality?', 'lumipix' ) => __( 'Making an image smaller keeps it sharp. Making it much larger than the original cannot add detail, so it may look soft.', 'lumipix' ),
			),
			'content' => '<!-- wp:heading --><h2 class="wp-block-heading">' . esc_html__( 'Resize for any purpose', 'lumipix' ) . '</h2><!-- /wp:heading --><!-- wp:paragraph --><p>' . esc_html__( 'Whether you need a 1920×1080 wallpaper, a 1080×1350 Instagram portrait, a 35×45 mm passport photo or a print at 300 DPI, the resizer handles it with one set of controls. Choose how the image should fit: keep the whole picture, crop to fill the frame, or add a background colour around it.', 'lumipix' ) . '</p><!-- /wp:paragraph --><!-- wp:heading --><h2 class="wp-block-heading">' . esc_html__( 'Pixels, centimetres, inches and DPI', 'lumipix' ) . '</h2><!-- /wp:heading --><!-- wp:paragraph --><p>' . esc_html__( 'Screens measure images in pixels, printers in centimetres or inches. The link between them is DPI (dots per inch). A 10 × 15 cm print at 300 DPI needs 1181 × 1772 pixels. Pick your unit and the resizer does the maths for you.', 'lumipix' ) . '</p><!-- /wp:paragraph -->',
		),
		'resize-image-in-cm'         => array(
			'app'     => 'resize',
			'group'   => 'resize',
			'parent'  => 'image-resizer',
			'slug'    => 'resize-image-in-cm-and-inches',
			'icon'    => 'ruler',
			'nav'     => __( 'Resize in cm & inches', 'lumipix' ),
			'h1'      => __( 'Resize image into inches or cm', 'lumipix' ),
			'title'   => __( 'Resize Image Into Inches, CM or MM for Print at 300 DPI', 'lumipix' ),
			'desc'    => __( 'Resize photos to exact print sizes in centimetres, millimetres or inches at 300 DPI: 10×15 cm, 4×6 in, A4 and more. Free and private.', 'lumipix' ),
			'lead'    => __( 'Exact print sizes with the right DPI written into the file, so photos print at the size you expect.', 'lumipix' ),
			'config'  => array( 'width' => 15, 'height' => 10, 'unit' => 'cm', 'dpi' => 300, 'fit' => 'cover', 'format' => 'image/jpeg', 'presets' => array( 'print-10x15', 'print-4x6', 'print-5x7', 'print-a5', 'print-a4' ) ),
			'related' => array( 'passport-size-photo', 'image-resizer', 'compress-image-to-2mb' ),
			'faqs'    => array(
				__( 'How do I resize an image in centimetres?', 'lumipix' ) => __( 'Choose cm as the unit, set the DPI (300 for photos), type the width and height and download. The pixels are calculated for you.', 'lumipix' ),
				__( 'What DPI should I use for printing?', 'lumipix' ) => __( '300 DPI for photos and documents held in the hand. 150 DPI is usually fine for posters viewed from a distance.', 'lumipix' ),
				__( 'Will the print come out at the right size?', 'lumipix' ) => __( 'Yes. The DPI is written into the JPG, so print software knows the intended physical size. Print at 100% scale.', 'lumipix' ),
			),
			'content' => '',
		),
		'resize-image-in-bulk'       => array(
			'app'     => 'resize',
			'group'   => 'resize',
			'parent'  => 'image-resizer',
			'slug'    => 'resize-image-in-bulk',
			'icon'    => 'layers',
			'nav'     => __( 'Resize in bulk', 'lumipix' ),
			'h1'      => __( 'Resize images in bulk', 'lumipix' ),
			'title'   => __( 'Resize Image in Bulk: Batch Resize 20 Photos at Once, Free', 'lumipix' ),
			'desc'    => __( 'Resize images in bulk: batch resize up to 20 JPG, PNG or WebP photos to the same width, pixels or print size and download them as one ZIP. Free, no upload.', 'lumipix' ),
			'lead'    => __( 'Drop up to 20 photos, set one size, and download them all as a ZIP. Nothing is uploaded.', 'lumipix' ),
			'config'  => array( 'width' => 1200, 'height' => 800, 'unit' => 'px', 'presets' => array( 'hd', 'fhd', 'square', 'ig-portrait', 'print-4x6' ) ),
			'related' => array( 'image-resizer', 'compress-image', 'png-to-jpg' ),
			'faqs'    => array(
				__( 'How many images can I resize at once?', 'lumipix' ) => __( 'Up to 20 images per batch. They are all resized with the same settings, and you can download them one by one or together as a ZIP file.', 'lumipix' ),
				__( 'Will photos with different shapes be stretched?', 'lumipix' ) => __( 'No. With the aspect lock on, every photo keeps its own proportions and only the width you set is applied. Turn the lock off to give every image the exact same frame.', 'lumipix' ),
				__( 'Are my images uploaded?', 'lumipix' ) => __( 'No. The batch is processed in your browser, on your own device. Nothing is sent to a server.', 'lumipix' ),
			),
			'content' => '',
		),
		'resize-image-to-1920x1080'  => array(
			'app'     => 'resize',
			'group'   => 'resize',
			'parent'  => 'image-resizer',
			'slug'    => 'resize-to-1920x1080',
			'icon'    => 'monitor',
			'nav'     => __( 'Resize to 1920×1080', 'lumipix' ),
			'h1'      => __( 'Resize image to 1920×1080', 'lumipix' ),
			'title'   => __( 'Resize Image to 1920×1080 (Full HD): No Stretching, Free', 'lumipix' ),
			'desc'    => __( 'Resize any photo to 1920×1080 Full HD for wallpapers, slides and screens. Fill to crop or fit with a background, never stretched. Free and private.', 'lumipix' ),
			'lead'    => __( 'Full HD wallpapers, slides and TV slideshows in one click, without stretching faces.', 'lumipix' ),
			'config'  => array( 'width' => 1920, 'height' => 1080, 'unit' => 'px', 'fit' => 'cover', 'presets' => array( 'fhd', 'hd', 'qhd', 'uhd' ) ),
			'related' => array( 'image-resizer', 'resize-youtube-thumbnail', 'compress-image-to-500kb' ),
			'faqs'    => array(
				__( 'How do I resize a picture to 1920×1080 without stretching?', 'lumipix' ) => __( 'Choose Fill to crop the photo to 16:9, or Fit to keep the whole photo and add a background colour. Avoid Stretch.', 'lumipix' ),
				__( 'Is 1920×1080 the same as 1080p?', 'lumipix' ) => __( 'Yes. 1080p, Full HD and 1920×1080 all describe the same 16:9 resolution.', 'lumipix' ),
				__( 'Can I resize several photos at once?', 'lumipix' ) => __( 'Yes. Drop up to 20 photos and use Download all.', 'lumipix' ),
				__( 'What size should a wallpaper be for a 4K screen?', 'lumipix' ) => __( 'Use 3840×2160 with the 4K preset so the wallpaper stays sharp at full screen. For two Full HD monitors side by side, type 3840×1080.', 'lumipix' ),
			),
			'content' => '',
		),
		'resize-image-for-instagram' => array(
			'app'     => 'resize',
			'group'   => 'resize',
			'parent'  => 'image-resizer',
			'slug'    => 'resize-image-for-instagram',
			'icon'    => 'instagram',
			'nav'     => __( 'Resize for Instagram', 'lumipix' ),
			'h1'      => __( 'Resize photo for Instagram', 'lumipix' ),
			'title'   => __( 'Resize Photo for Instagram: Post, Portrait and Story Sizes', 'lumipix' ),
			'desc'    => __( 'Resize photos for Instagram posts (1080×1080), portraits (1080×1350) and stories (1080×1920) without cropping important parts. Free and private.', 'lumipix' ),
			'lead'    => __( 'Square, portrait and story sizes in one tap. Fit the whole photo with a background, or crop to fill.', 'lumipix' ),
			'config'  => array( 'width' => 1080, 'height' => 1350, 'unit' => 'px', 'fit' => 'contain', 'presets' => array( 'ig-post', 'ig-portrait', 'ig-story', 'ig-landscape' ) ),
			'related' => array( 'image-resizer', 'compress-image', 'background-remover' ),
			'faqs'    => array(
				__( 'What is the best image size for Instagram?', 'lumipix' ) => __( 'Use 1080×1350 pixels (4:5) for portrait posts, 1080×1080 for square posts and 1080×1920 (9:16) for stories and reels covers.', 'lumipix' ),
				__( 'How do I post a full photo without Instagram cropping it?', 'lumipix' ) => __( 'Choose the Fit mode. The whole photo is placed inside the frame and the empty space is filled with a colour you pick, so nothing gets cut off.', 'lumipix' ),
				__( 'Will my photo lose quality?', 'lumipix' ) => __( 'The output is a high-quality JPG at the exact size Instagram displays, so the app does not need to recompress it heavily.', 'lumipix' ),
			),
			'content' => '<!-- wp:heading --><h2 class="wp-block-heading">' . esc_html__( 'Instagram image sizes at a glance', 'lumipix' ) . '</h2><!-- /wp:heading --><!-- wp:list --><ul class="wp-block-list"><li>' . esc_html__( 'Portrait post: 1080 × 1350 px (4:5), takes up the most space in the feed.', 'lumipix' ) . '</li><li>' . esc_html__( 'Square post: 1080 × 1080 px (1:1).', 'lumipix' ) . '</li><li>' . esc_html__( 'Landscape post: 1080 × 566 px (1.91:1).', 'lumipix' ) . '</li><li>' . esc_html__( 'Story and reel cover: 1080 × 1920 px (9:16).', 'lumipix' ) . '</li></ul><!-- /wp:list --><!-- wp:paragraph --><p>' . esc_html__( 'Uploading at exactly these sizes means Instagram does less processing, which keeps your photos sharper in the feed.', 'lumipix' ) . '</p><!-- /wp:paragraph -->',
		),
		'resize-image-for-facebook'  => array(
			'app'     => 'resize',
			'group'   => 'resize',
			'parent'  => 'image-resizer',
			'slug'    => 'resize-image-for-facebook',
			'icon'    => 'facebook',
			'nav'     => __( 'Resize for Facebook', 'lumipix' ),
			'h1'      => __( 'Resize photo for Facebook cover and posts', 'lumipix' ),
			'title'   => __( 'Resize Photo for Facebook Cover, Posts and Stories, Free', 'lumipix' ),
			'desc'    => __( 'Resize photos for Facebook posts, link previews, covers and stories without awkward crops. Free, private and works on mobile.', 'lumipix' ),
			'lead'    => __( 'Feed posts, link previews, covers and stories: the right shape for every Facebook placement.', 'lumipix' ),
			'config'  => array( 'width' => 1080, 'height' => 1080, 'unit' => 'px', 'fit' => 'contain', 'presets' => array( 'square', 'ig-portrait', 'fb-link', 'fb-cover', 'ig-story' ) ),
			'related' => array( 'resize-image-for-instagram', 'resize-youtube-thumbnail', 'background-remover' ),
			'faqs'    => array(
				__( 'What size is a Facebook post image?', 'lumipix' ) => __( '1080×1080 for square posts or 1080×1350 for portrait posts work well in the feed.', 'lumipix' ),
				__( 'What size is a Facebook link preview image?', 'lumipix' ) => __( '1200×630 pixels. Keep important content near the centre.', 'lumipix' ),
				__( 'How do I stop Facebook cropping my photo?', 'lumipix' ) => __( 'Resize it to the placement size with Fit, which keeps the whole photo and adds a background colour around it.', 'lumipix' ),
				__( 'What size is a Facebook cover photo?', 'lumipix' ) => __( 'Use a wide image such as 1640×624 and keep titles and faces in the centre, because desktop and phones crop covers differently.', 'lumipix' ),
			),
			'content' => '',
		),
		'resize-youtube-thumbnail'   => array(
			'app'     => 'resize',
			'group'   => 'resize',
			'parent'  => 'image-resizer',
			'slug'    => 'youtube-thumbnail-resizer',
			'icon'    => 'play',
			'nav'     => __( 'YouTube thumbnail', 'lumipix' ),
			'h1'      => __( 'YouTube thumbnail resizer', 'lumipix' ),
			'title'   => __( 'YouTube Thumbnail Resizer: 1280x720, Under 2MB, Free', 'lumipix' ),
			'desc'    => __( 'Resize any image to a 1280×720 YouTube thumbnail and keep it under the upload limit. Fill or fit, JPG or PNG. Free and private.', 'lumipix' ),
			'lead'    => __( 'Perfect 16:9 thumbnails at 1280×720, ready to upload with your next video.', 'lumipix' ),
			'config'  => array( 'width' => 1280, 'height' => 720, 'unit' => 'px', 'fit' => 'cover', 'format' => 'image/jpeg', 'presets' => array( 'hd', 'fhd' ) ),
			'related' => array( 'resize-image-to-1920x1080', 'compress-image-to-2mb', 'background-remover' ),
			'faqs'    => array(
				__( 'What size is a YouTube thumbnail?', 'lumipix' ) => __( 'YouTube recommends 1280×720 pixels (16:9). Check YouTube Help for the current file size limit.', 'lumipix' ),
				__( 'Can I use a 1920×1080 image as a thumbnail?', 'lumipix' ) => __( 'It has the same 16:9 shape, so it usually works, but 1280×720 keeps the file smaller.', 'lumipix' ),
				__( 'JPG or PNG for thumbnails?', 'lumipix' ) => __( 'JPG keeps photo thumbnails small. PNG suits designs with bold text and flat colours if the file stays under the limit.', 'lumipix' ),
				__( 'Why does my thumbnail look blurry on YouTube?', 'lumipix' ) => __( 'It was probably made from a small or heavily compressed image. Start from a sharp frame or design and resize it to 1280×720.', 'lumipix' ),
			),
			'content' => '',
		),
		'passport-size-photo'        => array(
			'app'     => 'resize',
			'group'   => 'resize',
			'parent'  => 'image-resizer',
			'slug'    => 'passport-size-photo',
			'icon'    => 'user',
			'nav'     => __( 'Passport size photo', 'lumipix' ),
			'h1'      => __( 'Passport size photo creator', 'lumipix' ),
			'title'   => __( 'Passport Size Photo Creator: 35x45 mm or 2x2 inch, Free', 'lumipix' ),
			'desc'    => __( 'Resize any photo to passport size (35×45 mm, 2×2 inch and more) at 300 DPI, ready to print or upload. Free and private.', 'lumipix' ),
			'lead'    => __( 'Crop and resize to standard passport and ID photo sizes, with the correct DPI for printing.', 'lumipix' ),
			'config'  => array( 'width' => 35, 'height' => 45, 'unit' => 'mm', 'dpi' => 300, 'fit' => 'cover', 'format' => 'image/jpeg', 'sheet' => '', 'presets' => array( 'passport', 'us-passport', 'id-card' ) ),
			'related' => array( 'passport-size-photo-india', 'canada-passport-photo', 'compress-image-to-50kb' ),
			'faqs'    => array(
				__( 'What size is a passport photo?', 'lumipix' ) => __( 'Many countries use 35 × 45 mm. The United States and some others use 2 × 2 inches (51 × 51 mm). Always confirm the rules of the authority you are applying to.', 'lumipix' ),
				__( 'What DPI should a passport photo be?', 'lumipix' ) => __( '300 DPI is the usual print standard. At 300 DPI a 35 × 45 mm photo is 413 × 531 pixels.', 'lumipix' ),
				__( 'Does this check biometric rules?', 'lumipix' ) => __( 'No. The tool sets size and resolution. Make sure your face is centred, well lit and against a plain light background as required by the issuing authority.', 'lumipix' ),
			),
			'content' => '<!-- wp:heading --><h2 class="wp-block-heading">' . esc_html__( 'Make a passport photo at home', 'lumipix' ) . '</h2><!-- /wp:heading --><!-- wp:paragraph --><p>' . esc_html__( 'Stand in front of a plain light wall, face the camera directly and take the photo in daylight. Drop it into the tool, pick the size, and Lumi Pix crops it to the exact proportions at 300 DPI. Print it on photo paper or upload it to your online application.', 'lumipix' ) . '</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>' . esc_html__( 'Need a clean white background? Use the background remover first, then come back to resize.', 'lumipix' ) . '</p><!-- /wp:paragraph -->',
		),
		'passport-size-photo-india'  => array(
			'app'     => 'resize',
			'group'   => 'resize',
			'parent'  => 'image-resizer',
			'slug'    => 'passport-size-photo-india',
			'icon'    => 'user',
			'nav'     => __( 'Indian passport photo', 'lumipix' ),
			'h1'      => __( 'Passport size photo for India', 'lumipix' ),
			'title'   => __( 'Passport Size Photo India: 35x45 mm or 2x2 inch, Free Maker', 'lumipix' ),
			'desc'    => __( 'Make a passport size photo for India: crop to 35x45 mm or 2x2 inch at 300 DPI and download one photo or a 4x6 print sheet. Free, private, no upload.', 'lumipix' ),
			'lead'    => __( 'Crop your photo to the size your Indian passport or visa form asks for, ready to print or upload.', 'lumipix' ),
			'config'  => array( 'width' => 35, 'height' => 45, 'unit' => 'mm', 'dpi' => 300, 'fit' => 'cover', 'format' => 'image/jpeg', 'sheet' => '', 'presets' => array( 'passport', 'us-passport' ) ),
			'related' => array( 'passport-size-photo', 'white-background-photo', 'compress-image-to-50kb' ),
			'faqs'    => array(
				__( 'What is the passport size photo size in India?', 'lumipix' ) => __( 'Applications made in India commonly ask for 35 × 45 mm (3.5 × 4.5 cm). Applications made through Indian missions in the United States often ask for 2 × 2 inches. Always follow the instructions of the office that will receive your form.', 'lumipix' ),
				__( 'What is 35 x 45 mm in pixels?', 'lumipix' ) => __( 'At 300 DPI, a 35 × 45 mm photo is 413 × 531 pixels. A 2 × 2 inch photo at 300 DPI is 600 × 600 pixels.', 'lumipix' ),
				__( 'Can I print several copies on one sheet?', 'lumipix' ) => __( 'Yes. Choose a print sheet and the tool places as many copies as fit on 4 × 6 in or 10 × 15 cm photo paper, with thin cut lines.', 'lumipix' ),
			),
			'content' => '',
		),
		'canada-passport-photo'      => array(
			'app'     => 'resize',
			'group'   => 'resize',
			'parent'  => 'image-resizer',
			'slug'    => 'canada-passport-photo-size',
			'icon'    => 'user',
			'nav'     => __( 'Canada passport photo', 'lumipix' ),
			'h1'      => __( 'Canada passport photo size', 'lumipix' ),
			'title'   => __( 'Canada Passport Photo Size: 50x70 mm at 300 DPI, Free Maker', 'lumipix' ),
			'desc'    => __( 'Canada passport photo size made easy: crop your photo to 50x70 mm at 300 DPI and download it or a 4x6 print sheet. Free, private, nothing uploaded.', 'lumipix' ),
			'lead'    => __( 'Crop to the 50 × 70 mm Canadian passport format at print resolution, then print at home or at a photo lab.', 'lumipix' ),
			'config'  => array( 'width' => 50, 'height' => 70, 'unit' => 'mm', 'dpi' => 300, 'fit' => 'cover', 'format' => 'image/jpeg', 'sheet' => '', 'presets' => array( 'canada-passport', 'passport', 'us-passport' ) ),
			'related' => array( 'passport-size-photo', 'white-background-photo', 'resize-image-in-cm' ),
			'faqs'    => array(
				__( 'What size is a Canadian passport photo?', 'lumipix' ) => __( 'Canadian passport photos are 50 mm wide and 70 mm high. Check the current Government of Canada photo specifications for the head size and other rules before you print.', 'lumipix' ),
				__( 'What is 50 x 70 mm in pixels?', 'lumipix' ) => __( 'At 300 DPI, 50 × 70 mm is 591 × 827 pixels. The tool calculates this for you and writes the DPI into the JPG.', 'lumipix' ),
				__( 'Can I use this for the online application?', 'lumipix' ) => __( 'The tool sets the size and resolution. Whether a home photo is accepted depends on the application type, so always confirm the current rules for the service you are using.', 'lumipix' ),
			),
			'content' => '',
		),
		'resize-signature'           => array(
			'app'     => 'compress',
			'group'   => 'resize',
			'parent'  => 'image-resizer',
			'slug'    => 'resize-signature',
			'icon'    => 'pen',
			'nav'     => __( 'Signature resizer', 'lumipix' ),
			'h1'      => __( 'Resize signature for online forms', 'lumipix' ),
			'title'   => __( 'Resize Signature Online: Compress to 10KB or 20KB, Free', 'lumipix' ),
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
			'h1'      => __( 'Remove background from image for free', 'lumipix' ),
			'title'   => __( 'Remove Background for Free Online: HD PNG, No Signup', 'lumipix' ),
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
			'content' => '<!-- wp:heading --><h2 class="wp-block-heading">' . esc_html__( 'A free alternative to paid background removers', 'lumipix' ) . '</h2><!-- /wp:heading --><!-- wp:paragraph --><p>' . esc_html__( 'Many background removers give you a small preview for free and ask you to sign up or pay for the full-resolution file. Lumi Pix runs the AI model directly in your browser, so there is no server cost to pass on: you get the full-size PNG without an account.', 'lumipix' ) . '</p><!-- /wp:paragraph --><!-- wp:heading --><h2 class="wp-block-heading">' . esc_html__( 'Works best with', 'lumipix' ) . '</h2><!-- /wp:heading --><!-- wp:list --><ul class="wp-block-list"><li>' . esc_html__( 'Portraits and profile pictures', 'lumipix' ) . '</li><li>' . esc_html__( 'Product photos for online stores', 'lumipix' ) . '</li><li>' . esc_html__( 'Passport and ID photos that need a plain background', 'lumipix' ) . '</li></ul><!-- /wp:list --><!-- wp:paragraph --><p>' . esc_html__( 'For logos, signatures and scans on white paper, the white background remover is faster and gives crisper edges.', 'lumipix' ) . '</p><!-- /wp:paragraph -->',
		),
		'white-background-photo'     => array(
			'app'     => 'bg',
			'group'   => 'background',
			'parent'  => 'background-remover',
			'slug'    => 'white-background-photo',
			'icon'    => 'palette',
			'nav'     => __( 'White background photo', 'lumipix' ),
			'h1'      => __( 'Change photo background to white', 'lumipix' ),
			'title'   => __( 'Change Photo Background to White: Passport Photo, Free', 'lumipix' ),
			'desc'    => __( 'Turn any photo background white or any colour with on-device AI. Ideal for ID photos, profiles and product listings. Free HD download, nothing uploaded.', 'lumipix' ),
			'lead'    => __( 'A clean white (or any colour) background for ID photos, profiles and products, in one step.', 'lumipix' ),
			'config'  => array( 'background' => '#ffffff' ),
			'related' => array( 'passport-size-photo', 'background-remover', 'resize-image-for-instagram' ),
			'faqs'    => array(
				__( 'How do I make a photo background white?', 'lumipix' ) => __( 'Drop the photo. The AI separates the subject and places it on white. Download as JPG.', 'lumipix' ),
				__( 'Can I choose another colour?', 'lumipix' ) => __( 'Yes. Pick any swatch or a custom colour before downloading, or keep it transparent as PNG.', 'lumipix' ),
				__( 'Is this suitable for passport photos?', 'lumipix' ) => __( 'It gives a plain background. Then crop to size with the passport photo maker and check your authority\'s rules.', 'lumipix' ),
				__( 'Is the download full resolution?', 'lumipix' ) => __( 'Yes. The result has the same resolution as your original photo, with no watermark and no account needed.', 'lumipix' ),
			),
			'content' => '',
		),
		'remove-white-background'    => array(
			'app'     => 'colorkey',
			'group'   => 'background',
			'parent'  => 'background-remover',
			'slug'    => 'remove-white-background',
			'icon'    => 'droplet',
			'nav'     => __( 'Remove white background', 'lumipix' ),
			'h1'      => __( 'Remove white background', 'lumipix' ),
			'title'   => __( 'Remove White Background from Image: Transparent PNG, Free', 'lumipix' ),
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
		'remove-black-background'    => array(
			'app'     => 'colorkey',
			'group'   => 'background',
			'parent'  => 'background-remover',
			'slug'    => 'remove-black-background',
			'icon'    => 'contrast',
			'nav'     => __( 'Remove black background', 'lumipix' ),
			'h1'      => __( 'Remove black background', 'lumipix' ),
			'title'   => __( 'Remove Black Background from Image: Transparent PNG, Free', 'lumipix' ),
			'desc'    => __( 'Make the black background of logos, icons, light effects and screenshots transparent in one click. Instant, free and private.', 'lumipix' ),
			'lead'    => __( 'Turn black or any dark solid colour transparent, perfect for logos, icons and glowing effects.', 'lumipix' ),
			'config'  => array( 'color' => '#000000', 'tolerance' => 18, 'feather' => 14 ),
			'related' => array( 'remove-white-background', 'background-remover', 'image-resizer' ),
			'faqs'    => array(
				__( 'How do I remove a black background?', 'lumipix' ) => __( 'Drop the image. Black areas turn transparent instantly. Adjust tolerance for dark grey areas and download as PNG.', 'lumipix' ),
				__( 'Will dark parts of my logo disappear too?', 'lumipix' ) => __( 'Parts close to black can. Lower the tolerance until only the background is removed.', 'lumipix' ),
				__( 'Does it work for glow and light effects?', 'lumipix' ) => __( 'Yes. Edge softness keeps the soft glow, so effects blend naturally on new backgrounds.', 'lumipix' ),
				__( 'Can I remove a dark blue or grey background instead?', 'lumipix' ) => __( 'Yes. Click Pick from image and then the background, or choose the colour with the picker. Any solid colour can be removed.', 'lumipix' ),
			),
			'content' => '',
		),

		/* ---------------------------------------------------------------
		 * Convert
		 * ------------------------------------------------------------- */
		'webp-to-jpg' => array(
			'app'     => 'convert',
			'group'   => 'convert',
			'parent'  => '',
			'slug'    => 'webp-to-jpg',
			'icon'    => 'convert',
			'nav'     => __( 'WebP to JPG', 'lumipix' ),
			'h1'      => __( 'Convert WebP to JPG', 'lumipix' ),
			'title'   => __( 'Convert WebP to JPG Online: Free, Private, No Upload', 'lumipix' ),
			'desc'    => __( 'Convert WebP to JPG in your browser. Up to 20 images at once, adjustable quality, Download all as ZIP. No upload, no signup, no watermark.', 'lumipix' ),
			'lead'    => __( 'Turn WebP images into JPGs that open everywhere, right in your browser.', 'lumipix' ),
			'config'  => array( 'to' => 'image/jpeg', 'quality' => 92 ),
			'related' => array( 'webp-to-png', 'png-to-jpg', 'compress-image' ),
			'faqs'    => array(
				__( 'Are my WebP files uploaded to a server?', 'lumipix' ) => __( 'No. The conversion runs entirely in your browser, so your images never leave your device.', 'lumipix' ),
				__( 'What happens to transparent areas when I save WebP as JPG?', 'lumipix' ) => __( 'JPG cannot store transparency, so transparent pixels are filled with the Background colour you choose, which is white by default. Convert to PNG instead if you need to keep transparency.', 'lumipix' ),
				__( 'Why is my JPG bigger than the original WebP?', 'lumipix' ) => __( 'WebP usually compresses more efficiently than JPG, so the same image often takes more space as a JPG. Lowering the Quality slider makes the file smaller.', 'lumipix' ),
				__( 'Can I convert an animated WebP to JPG?', 'lumipix' ) => __( 'Only the first frame is converted, because a JPG holds a single image.', 'lumipix' ),
			),
			'content' => '',
		),
		'webp-to-png' => array(
			'app'     => 'convert',
			'group'   => 'convert',
			'parent'  => '',
			'slug'    => 'webp-to-png',
			'icon'    => 'file-image',
			'nav'     => __( 'WebP to PNG', 'lumipix' ),
			'h1'      => __( 'Convert WebP to PNG', 'lumipix' ),
			'title'   => __( 'Convert WebP to PNG Online: Keeps Transparency, Free', 'lumipix' ),
			'desc'    => __( 'Convert WebP to PNG and keep transparent backgrounds. Lossless output, up to 20 images at once, Download all as ZIP. No upload or watermark.', 'lumipix' ),
			'lead'    => __( 'Change WebP images to lossless PNG files and keep every transparent pixel.', 'lumipix' ),
			'config'  => array( 'to' => 'image/png', 'quality' => 92 ),
			'related' => array( 'webp-to-jpg', 'png-to-webp', 'background-remover' ),
			'faqs'    => array(
				__( 'Does converting WebP to PNG keep the transparent background?', 'lumipix' ) => __( 'Yes. PNG supports transparency, so transparent areas in the WebP stay transparent in the PNG.', 'lumipix' ),
				__( 'Why is there no quality slider for PNG?', 'lumipix' ) => __( 'PNG is lossless, so the pixels are saved exactly as decoded and there is nothing to adjust.', 'lumipix' ),
				__( 'Will the PNG look better than the WebP?', 'lumipix' ) => __( 'No. The PNG keeps the image exactly as it is, including any compression artefacts in the original, but it will not lose any more quality when you edit and save it again.', 'lumipix' ),
				__( 'Why is the PNG file larger?', 'lumipix' ) => __( 'PNG stores every pixel without lossy compression, so it is usually bigger than a WebP, especially for photos. For photos without transparency, JPG is often the better choice.', 'lumipix' ),
			),
			'content' => '',
		),
		'png-to-jpg' => array(
			'app'     => 'convert',
			'group'   => 'convert',
			'parent'  => '',
			'slug'    => 'png-to-jpg',
			'icon'    => 'image',
			'nav'     => __( 'PNG to JPG', 'lumipix' ),
			'h1'      => __( 'Turn PNG to JPG online', 'lumipix' ),
			'title'   => __( 'Turn PNG to JPG Online: Free, Fast, No Upload', 'lumipix' ),
			'desc'    => __( 'Convert PNG to JPG to shrink screenshots, scans and photos. Set quality and background colour, convert 20 files at once. Free, private, no upload.', 'lumipix' ),
			'lead'    => __( 'Turn large PNG screenshots, scans and photos into smaller JPGs in seconds.', 'lumipix' ),
			'config'  => array( 'to' => 'image/jpeg', 'quality' => 90 ),
			'related' => array( 'jpg-to-png', 'compress-image', 'webp-to-jpg' ),
			'faqs'    => array(
				__( 'What happens to the transparent background of my PNG?', 'lumipix' ) => __( 'JPG has no transparency, so transparent areas are filled with the Background colour you pick. White is the default, but you can choose any colour.', 'lumipix' ),
				__( 'Will converting PNG to JPG reduce the file size?', 'lumipix' ) => __( 'Usually yes for photos, scans and detailed screenshots. Simple graphics with flat colours may not get much smaller, and each result shows the old and new size so you can check.', 'lumipix' ),
				__( 'What quality setting should I use?', 'lumipix' ) => __( 'The default of 92 suits most images. Values from 80 to 92 give smaller files with little visible change, and text-heavy screenshots look best at 90 or above.', 'lumipix' ),
				__( 'Does the image size in pixels change?', 'lumipix' ) => __( 'No. The JPG keeps the same pixel dimensions as the PNG; use the Image Resizer if you also want to change them.', 'lumipix' ),
			),
			'content' => '',
		),
		'jpg-to-png' => array(
			'app'     => 'convert',
			'group'   => 'convert',
			'parent'  => '',
			'slug'    => 'jpg-to-png',
			'icon'    => 'layers',
			'nav'     => __( 'JPG to PNG', 'lumipix' ),
			'h1'      => __( 'JPG to PNG online converter', 'lumipix' ),
			'title'   => __( 'JPG to PNG Online Converter: Free, Lossless, No Upload', 'lumipix' ),
			'desc'    => __( 'Convert JPG to PNG for editing, lossless saving or uploads that require PNG. Up to 20 images at once, no upload, no signup, no watermark.', 'lumipix' ),
			'lead'    => __( 'Save JPG photos as lossless PNG files for editing or uploads that need PNG.', 'lumipix' ),
			'config'  => array( 'to' => 'image/png', 'quality' => 92 ),
			'related' => array( 'png-to-jpg', 'remove-white-background', 'image-resizer' ),
			'faqs'    => array(
				__( 'Does converting JPG to PNG improve image quality?', 'lumipix' ) => __( 'No. The PNG contains the same pixels as the JPG, but it will not lose any more quality when you edit and save it again.', 'lumipix' ),
				__( 'Why is my PNG bigger than the JPG?', 'lumipix' ) => __( 'PNG is lossless and does not use the lossy compression that keeps JPGs small, so the file usually gets larger.', 'lumipix' ),
				__( 'Will the background become transparent?', 'lumipix' ) => __( 'No. Converting keeps the background exactly as it is; use the Background Remover or Remove white background tool to make it transparent.', 'lumipix' ),
				__( 'Is my photo uploaded anywhere?', 'lumipix' ) => __( 'No. The conversion happens in your browser, and EXIF metadata such as GPS location is removed from the result.', 'lumipix' ),
			),
			'content' => '',
		),
		'avif-to-jpg' => array(
			'app'     => 'convert',
			'group'   => 'convert',
			'parent'  => '',
			'slug'    => 'avif-to-jpg',
			'icon'    => 'sparkles',
			'nav'     => __( 'AVIF to JPG', 'lumipix' ),
			'h1'      => __( 'Convert AVIF to JPG', 'lumipix' ),
			'title'   => __( 'Convert AVIF to JPG: Free, Private, Batch of 20', 'lumipix' ),
			'desc'    => __( 'Convert AVIF to JPG in your browser. Up to 20 images at once, quality slider, background colour for transparency, ZIP download. No upload, no signup.', 'lumipix' ),
			'lead'    => __( 'Turn AVIF images into JPGs that open in any app, right in your browser.', 'lumipix' ),
			'config'  => array( 'to' => 'image/jpeg', 'quality' => 92 ),
			'related' => array( 'webp-to-jpg', 'png-to-jpg', 'compress-image' ),
			'faqs'    => array(
				__( 'Why won\'t my AVIF file open in this converter?', 'lumipix' ) => __( 'Your browser has to decode AVIF itself. Use a current version of Chrome, Edge, Firefox or Safari 16.4 or newer.', 'lumipix' ),
				__( 'What happens to transparent areas in an AVIF?', 'lumipix' ) => __( 'JPG cannot store transparency, so transparent areas are filled with the Background colour you choose, which is white by default. Switch Convert to PNG or WebP if you need to keep transparency.', 'lumipix' ),
				__( 'Why is my JPG bigger than the original AVIF?', 'lumipix' ) => __( 'AVIF usually compresses more efficiently than JPG, so a JPG of similar quality often needs more bytes. Lower the Quality slider or compress the JPG afterwards if size matters.', 'lumipix' ),
				__( 'Are my images uploaded anywhere?', 'lumipix' ) => __( 'No. The conversion runs entirely in your browser, and re-encoding also removes EXIF metadata such as GPS location.', 'lumipix' ),
			),
			'content' => '',
		),
		'png-to-webp' => array(
			'app'     => 'convert',
			'group'   => 'convert',
			'parent'  => '',
			'slug'    => 'png-to-webp',
			'icon'    => 'zap',
			'nav'     => __( 'PNG to WebP', 'lumipix' ),
			'h1'      => __( 'Convert PNG to WebP', 'lumipix' ),
			'title'   => __( 'Convert PNG to WebP: Keep Transparency, Free', 'lumipix' ),
			'desc'    => __( 'Convert PNG to WebP for faster websites. Transparency kept, quality slider, up to 20 images per batch and ZIP download. Free and private, in your browser.', 'lumipix' ),
			'lead'    => __( 'Make PNG images much lighter for your website while keeping transparent backgrounds.', 'lumipix' ),
			'config'  => array( 'to' => 'image/webp', 'quality' => 85 ),
			'related' => array( 'webp-to-png', 'compress-image', 'image-resizer' ),
			'faqs'    => array(
				__( 'Does WebP keep the transparent background of my PNG?', 'lumipix' ) => __( 'Yes. WebP supports transparency, so transparent areas in your PNG stay transparent after conversion.', 'lumipix' ),
				__( 'Which Quality setting should I use?', 'lumipix' ) => __( 'The default of 92 suits most images. Photos can often go lower, while screenshots, text and logos look best at higher values.', 'lumipix' ),
				__( 'Will the image dimensions change?', 'lumipix' ) => __( 'No, the WebP keeps the same width and height in pixels. Resize the image first if it is larger than your page layout needs.', 'lumipix' ),
				__( 'Can I convert several PNG files at once?', 'lumipix' ) => __( 'Yes, you can convert up to 20 images in one batch and save them all as a single ZIP with Download all.', 'lumipix' ),
			),
			'content' => '',
		),
		'svg-to-png' => array(
			'app'     => 'convert',
			'group'   => 'convert',
			'parent'  => '',
			'slug'    => 'svg-to-png',
			'icon'    => 'code',
			'nav'     => __( 'SVG to PNG', 'lumipix' ),
			'h1'      => __( 'SVG to PNG converter', 'lumipix' ),
			'title'   => __( 'Online SVG to PNG Converter: Any Size, Transparent, Free', 'lumipix' ),
			'desc'    => __( 'Convert SVG to PNG at 1×, 2×, 4× or a custom width with the transparent background kept. Batch up to 20 files, no upload, free in your browser.', 'lumipix' ),
			'lead'    => __( 'Turn SVG logos and icons into sharp PNGs at exactly the size you need.', 'lumipix' ),
			'config'  => array( 'to' => 'image/png', 'quality' => 92, 'svg' => true ),
			'related' => array( 'favicon-generator', 'png-to-webp', 'image-resizer' ),
			'faqs'    => array(
				__( 'How do I get a high-resolution PNG from an SVG?', 'lumipix' ) => __( 'Choose 2× or 4× under Size, or type a custom width in pixels. The height follows the aspect ratio automatically.', 'lumipix' ),
				__( 'Is the transparent background kept?', 'lumipix' ) => __( 'Yes, the PNG keeps the SVG\'s transparent background. If you need a solid colour instead, switch Convert to JPG and pick a Background colour.', 'lumipix' ),
				__( 'Why is the text in my PNG in a different font?', 'lumipix' ) => __( 'SVGs that load external fonts or images may render with fallback fonts. Convert text to outlines in your design app and export the SVG again.', 'lumipix' ),
				__( 'Is there a quality setting for PNG?', 'lumipix' ) => __( 'No, PNG is lossless, so every pixel is saved exactly and no quality slider is needed.', 'lumipix' ),
			),
			'content' => '',
		),
		'image-to-pdf' => array(
			'app'     => 'pdf',
			'group'   => 'convert',
			'parent'  => '',
			'slug'    => 'image-to-pdf',
			'icon'    => 'file',
			'nav'     => __( 'Image to PDF', 'lumipix' ),
			'h1'      => __( 'Make JPG to PDF online', 'lumipix' ),
			'title'   => __( 'Make JPG to PDF Online: Combine Images into One PDF, Free', 'lumipix' ),
			'desc'    => __( 'Free image to PDF converter: combine up to 20 JPG, PNG or WebP images into one PDF. Reorder pages, pick page size and margins. Private, no upload.', 'lumipix' ),
			'lead'    => __( 'Combine photos, scans and screenshots into one PDF, in the order you choose.', 'lumipix' ),
			'config'  => array(),
			'related' => array( 'compress-image-to-200kb', 'crop-image', 'png-to-jpg' ),
			'faqs'    => array(
				__( 'How many images can I put in one PDF?', 'lumipix' ) => __( 'You can add up to 20 images, and each one becomes its own page in a single PDF.', 'lumipix' ),
				__( 'Will my images be stretched to fit the page?', 'lumipix' ) => __( 'No. Each image is scaled to fit the page and centred, keeping its proportions; choose Same as image under Page size to avoid white borders.', 'lumipix' ),
				__( 'Can I select or search the text in the PDF?', 'lumipix' ) => __( 'No, the images are placed as pictures and there is no OCR, so text in photos is not converted into selectable text.', 'lumipix' ),
				__( 'Is it safe to use for ID cards and documents?', 'lumipix' ) => __( 'Yes. The PDF is created on your device and downloaded directly, so your images are never uploaded.', 'lumipix' ),
			),
			'content' => '',
		),

		/* ---------------------------------------------------------------
		 * More tools
		 * ------------------------------------------------------------- */
		'favicon-generator' => array(
			'app'     => 'favicon',
			'group'   => 'more',
			'parent'  => '',
			'slug'    => 'favicon-generator',
			'icon'    => 'app-window',
			'nav'     => __( 'Favicon generator', 'lumipix' ),
			'h1'      => __( 'Favicon generator: logo to ICO', 'lumipix' ),
			'title'   => __( 'Favicon to ICO Generator: Make favicon.ico From a Logo, Free', 'lumipix' ),
			'desc'    => __( 'Free favicon generator: create favicon.ico, Apple touch and Android icons from a logo, letter or emoji, with a ready HTML snippet. No upload.', 'lumipix' ),
			'lead'    => __( 'Turn a logo, a letter or an emoji into a complete favicon package in seconds.', 'lumipix' ),
			'config'  => array(),
			'related' => array( 'svg-to-png', 'crop-image', 'remove-white-background' ),
			'faqs'    => array(
				__( 'Which files are in the favicon package?', 'lumipix' ) => __( 'The ZIP contains favicon.ico (with 16, 32 and 48 px), favicon-16x16.png, favicon-32x32.png, a 180×180 apple-touch-icon.png, Android icons at 192 and 512 px, and site.webmanifest.', 'lumipix' ),
				__( 'How do I install the favicon on my website?', 'lumipix' ) => __( 'Upload all the files to your site\'s root folder, such as public_html, and paste the HTML snippet into the head of your pages. On WordPress you can also set a 512×512 PNG as Site Icon under Appearance → Customize → Site Identity.', 'lumipix' ),
				__( 'Why does the Apple touch icon have a background colour?', 'lumipix' ) => __( 'iOS does not support transparency for home screen icons, so apple-touch-icon.png always gets a solid background. Pick a colour that suits your logo.', 'lumipix' ),
				__( 'Why does Google not show my favicon yet?', 'lumipix' ) => __( 'Google needs a square favicon of at least 48×48 px that it can crawl, and it can take days or weeks to appear in search results.', 'lumipix' ),
			),
			'content' => '',
		),
		'change-image-dpi' => array(
			'app'     => 'dpi',
			'group'   => 'more',
			'parent'  => '',
			'slug'    => 'change-image-dpi',
			'icon'    => 'printer',
			'nav'     => __( 'Change image DPI', 'lumipix' ),
			'h1'      => __( 'Change image DPI', 'lumipix' ),
			'title'   => __( 'How to Change Image DPI to 300 Online, No Quality Loss', 'lumipix' ),
			'desc'    => __( 'Change image DPI to 300, 600 or any value from 1 to 2400. JPG and PNG are not re-compressed, so quality stays identical. Free, private, no upload.', 'lumipix' ),
			'lead'    => __( 'Set the DPI a printer or form asks for, without re-compressing your photo.', 'lumipix' ),
			'config'  => array( 'mode' => 'change', 'dpi' => 300 ),
			'related' => array( 'check-image-dpi', 'resize-image-in-cm', 'passport-size-photo' ),
			'faqs'    => array(
				__( 'Does changing the DPI improve image quality?', 'lumipix' ) => __( 'No. DPI only changes how large the image prints; it does not add pixels or sharpen anything. To print a larger size sharply you need more pixels from the start.', 'lumipix' ),
				__( 'Will my JPG lose quality when I change its DPI?', 'lumipix' ) => __( 'No. For JPG and PNG only the stored DPI value is rewritten and the pixels are not re-compressed, so quality is identical and the file size barely changes.', 'lumipix' ),
				__( 'Will Windows and Photoshop see the new DPI?', 'lumipix' ) => __( 'Yes. For JPG both the JFIF header and the EXIF resolution are updated, so Windows Properties, Photoshop and print shops read the new value. PNG files get a pHYs chunk.', 'lumipix' ),
				__( 'Why did my WebP file come back as a PNG?', 'lumipix' ) => __( 'WebP, AVIF, GIF and BMP images are converted to PNG with the DPI set, so the value is stored reliably.', 'lumipix' ),
			),
			'content' => '',
		),
		'check-image-dpi' => array(
			'app'     => 'dpi',
			'group'   => 'more',
			'parent'  => '',
			'slug'    => 'check-image-dpi',
			'icon'    => 'scan',
			'nav'     => __( 'Check image DPI', 'lumipix' ),
			'h1'      => __( 'Image resolution and DPI checker', 'lumipix' ),
			'title'   => __( 'Image Resolution Checker: Check DPI and Print Size, Free', 'lumipix' ),
			'desc'    => __( 'Check image DPI for free: see the stored DPI, pixel size and the largest sharp print at 300 DPI for up to 20 photos. Nothing is uploaded or changed.', 'lumipix' ),
			'lead'    => __( 'See the DPI stored in your photo and how large it prints sharply.', 'lumipix' ),
			'config'  => array( 'mode' => 'check' ),
			'related' => array( 'change-image-dpi', 'resize-image-in-cm', 'image-resizer' ),
			'faqs'    => array(
				__( 'What does "No DPI stored" mean?', 'lumipix' ) => __( 'The file does not contain a DPI value, which is common for screenshots and web images. Many apps then assume 72 or 96 DPI.', 'lumipix' ),
				__( 'My photo says 72 DPI. Can it still print at 300 DPI?', 'lumipix' ) => __( 'Often yes, if it has enough pixels. Check the largest sharp print size at 300 DPI in the results, then set the value with the Change image DPI tool.', 'lumipix' ),
				__( 'Where does the checker find the DPI?', 'lumipix' ) => __( 'It reads the JFIF header or EXIF data in JPG files and the pHYs chunk in PNG files, and tells you which source it used.', 'lumipix' ),
				__( 'Does the checker change or upload my images?', 'lumipix' ) => __( 'No. Your images are read on your device and nothing is changed, uploaded or downloaded.', 'lumipix' ),
			),
			'content' => '',
		),
		'crop-image' => array(
			'app'     => 'crop',
			'group'   => 'more',
			'parent'  => '',
			'slug'    => 'crop-image',
			'icon'    => 'crop',
			'nav'     => __( 'Crop image', 'lumipix' ),
			'h1'      => __( 'Crop image tool', 'lumipix' ),
			'title'   => __( 'Crop Image Tool Online: Square, 16:9 or Exact Pixels, Free', 'lumipix' ),
			'desc'    => __( 'Crop image online for free: drag the box, choose 1:1, 4:5, 16:9 or exact pixels, rotate or flip, and save at full resolution. No upload, no signup.', 'lumipix' ),
			'lead'    => __( 'Drag a box over the part you want and download it at full resolution.', 'lumipix' ),
			'config'  => array(),
			'related' => array( 'image-resizer', 'resize-image-for-instagram', 'passport-size-photo' ),
			'faqs'    => array(
				__( 'How do I crop an image to a square?', 'lumipix' ) => __( 'Click the 1:1 ratio, then drag the crop box over your subject and resize it with the corner handles. The box keeps its square shape.', 'lumipix' ),
				__( 'Can I crop to an exact size in pixels?', 'lumipix' ) => __( 'Yes. Type the width and height in pixels and the crop box takes that size, as long as it fits inside the image.', 'lumipix' ),
				__( 'Does cropping reduce image quality?', 'lumipix' ) => __( 'No. The crop is saved at full resolution with no upscaling; JPG and WebP only go through their normal compression when saved.', 'lumipix' ),
				__( 'Can I crop several images at once?', 'lumipix' ) => __( 'No, the cropper works on one image at a time so you can position each crop precisely.', 'lumipix' ),
			),
			'content' => '',
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
	if ( isset( $tools[ $key ] ) ) {
		return $tools[ $key ];
	}
	// Translated tool pages (fr-…, pt-…), see inc/lang.php.
	return function_exists( 'lumipix_lang_tool' ) ? lumipix_lang_tool( $key ) : null;
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
	if ( ! empty( $tool['lang'] ) ) {
		return lumipix_lang_tools( $tool['lang'] );
	}
	$root = $tool['parent'] ? $tool['parent'] : $key;
	$out  = array();
	foreach ( lumipix_tools() as $k => $t ) {
		if ( $k === $root || $t['parent'] === $root ) {
			$out[ $k ] = $t;
		}
	}
	// Standalone tools (converters, utilities) show the rest of their group instead.
	if ( count( $out ) < 2 ) {
		$out = lumipix_group_tools( $tool['group'] );
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
			'foto-3x4'     => array( 'label' => 'Foto 3×4 cm', 'w' => 3, 'h' => 4, 'unit' => 'cm', 'dpi' => 300 ),
			'canada-passport' => array( 'label' => 'Canada passport 50×70 mm', 'w' => 50, 'h' => 70, 'unit' => 'mm', 'dpi' => 300 ),
			'qhd'          => array( 'label' => 'QHD 2560×1440', 'w' => 2560, 'h' => 1440, 'unit' => 'px' ),
			'uhd'          => array( 'label' => '4K 3840×2160', 'w' => 3840, 'h' => 2160, 'unit' => 'px' ),
			'fb-link'      => array( 'label' => 'Link preview 1200×630', 'w' => 1200, 'h' => 630, 'unit' => 'px' ),
			'fb-cover'     => array( 'label' => 'Cover 1640×624', 'w' => 1640, 'h' => 624, 'unit' => 'px' ),
			'print-10x15'  => array( 'label' => '10×15 cm', 'w' => 15, 'h' => 10, 'unit' => 'cm', 'dpi' => 300 ),
			'print-4x6'    => array( 'label' => '4×6 in', 'w' => 6, 'h' => 4, 'unit' => 'in', 'dpi' => 300 ),
			'print-5x7'    => array( 'label' => '5×7 in', 'w' => 7, 'h' => 5, 'unit' => 'in', 'dpi' => 300 ),
			'print-a5'     => array( 'label' => 'A5 210×148 mm', 'w' => 210, 'h' => 148, 'unit' => 'mm', 'dpi' => 300 ),
			'print-a4'     => array( 'label' => 'A4 297×210 mm', 'w' => 297, 'h' => 210, 'unit' => 'mm', 'dpi' => 300 ),
		)
	);
}
