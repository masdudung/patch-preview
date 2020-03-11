
<?php
/**
 * Plugin Name: patch preview post
 * Version: 0.0.1
 * Author: SoftwareSeni Team
 * 
 */

class patch_preview{
    
    function __construct()
    {
        add_action( 'admin_footer', [$this, 'fix_preview_link_on_draft']); 
    }

    function fix_preview_link_on_draft() {
        echo '<script type="text/javascript">
		jQuery(document).ready(function () {
			const checkPreviewInterval = setInterval(checkPreview, 1000);
			function checkPreview() {
				const editorPreviewButton = jQuery(".editor-post-preview");
				const editorPostSaveDraft = jQuery(".editor-post-save-draft");
				if (editorPostSaveDraft.length && editorPreviewButton.length && editorPreviewButton.attr("href") !== "' . get_preview_post_link() . '" ) {
					editorPreviewButton.attr("href", "' . get_preview_post_link() . '");
					editorPreviewButton.off();
					editorPreviewButton.click(false);
					editorPreviewButton.on("click", function() {
						editorPostSaveDraft.click();
						setTimeout(function() { 
							const win = window.open("' . get_preview_post_link() . '", "_blank");
							if (win) {
								win.focus();
							}
						}, 1000);
					});
				}
			}
		});
	</script>';
    }
}
$plugin = new patch_preview();
