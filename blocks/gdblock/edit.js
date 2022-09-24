import { useBlockProps } from "@wordpress/block-editor"

export function GDBlockEdit(props) {

    const blockProps = useBlockProps()
    return (
        <div {...blockProps}>
        </div>
    );
}