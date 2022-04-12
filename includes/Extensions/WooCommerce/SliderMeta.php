<?php
declare(strict_types=1);

namespace CleanWeb\Extensions\WooCommerce;

use CleanWeb\Extensions\Manifest;

class SliderMeta implements \CleanWeb\Component {

	public const IMAGES = 'slider_images';

	public function __construct(
			private Manifest $manifest
	) {}

	public function initialize(): void {
		add_action( 'add_meta_boxes', [ $this, 'register_meta_box' ] );
		add_action( 'save_post_page', [ $this, 'save_meta_box' ], 10, 3 );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
	}

	public function enqueue_scripts(): void {
		wp_enqueue_media();
		// wp_enqueue_script( 'slider', get_stylesheet_directory_uri() . DIRECTORY_SEPARATOR . $this->manifest['assets/js/admin.ts'], Theme::VERSION );
	}

	public function register_meta_box(): void {
		add_meta_box(
			'slider',
			'Slider',
			[ $this, 'shop_meta_fields' ],
			'page',
			'normal',
			'high'
		);
	}

	public function shop_meta_fields(): void {
		$value = get_post_meta( get_the_ID(), self::IMAGES, true );
		?>
		<style>
			.js-attachments-container {
				display: flex;
				flex-wrap: wrap;
			}

			.js-attachments-container p {
				position: relative;
			}

			.remove-attachment-button {
				position: absolute;
				top: 0;
				right: 0;
				background: #ededed;
				color: #3f3f3f;
				border-radius: 4px;
				padding: 0.9ex 1.5ex;
				text-decoration: none;
			}
		</style>
		<div id="slider-id">
			<?php if ( ! empty( $value ) ) : ?>
				<?php foreach ( (array) $value as $single_attachment_url ) : ?>
					<input type="hidden"
						   value="<?php echo esc_url( $single_attachment_url ); ?>"
						   name="<?php echo esc_attr( self::IMAGES . '[]' ); ?>"/>
				<?php endforeach; ?>
			<?php endif; ?>
			<p class="hide-if-no-js">
				<a class="js-add-attachment" href="#">Dodaj zdjęcia do slidera</a>
			</p>
			<div class="js-attachments-container">
				<?php if ( ! empty( $value ) ) : ?>
					<?php foreach ( (array) $value as $single_attachment_url ) : ?>
						<p>
							<img src="<?php echo esc_url( $single_attachment_url ); ?>" width="200" alt=""/>
							<a href="#" class="js-remove-attachment remove-attachment-button">&#10799</a>
						</p>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}

	public function save_meta_box( int $post_id ): void {
		if (
			( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) ||
			! current_user_can( 'edit_page', $post_id )
		) {
			return;
		}

		$new = array_map( 'esc_url_raw', $_POST[ self::IMAGES ] ?? [] );

		update_post_meta( $post_id, self::IMAGES, $new );
	}
}
