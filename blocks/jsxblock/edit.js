import { InnerBlocks, InspectorControls, MediaUpload, MediaUploadCheck, useBlockProps } from "@wordpress/block-editor"
import { Button, PanelBody, PanelRow } from "@wordpress/components"
import apiFetch from "@wordpress/api-fetch"
import { useEffect } from "@wordpress/element"

export function JSXBlockEdit(props) {

    const blockProps = useBlockProps()
    return (
        <div {...blockProps}>
            
        </div>
    );
}