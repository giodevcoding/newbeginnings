import { useBlockProps } from "@wordpress/block-editor"
import "./render.scss"

export function GDBlock(props) {
    const blockProps = useBlockProps.save();

    return ( 
        <div {...blockProps}>
        </div> 
    )
}