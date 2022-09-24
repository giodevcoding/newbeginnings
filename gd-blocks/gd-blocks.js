import { useBlockProps } from "@wordpress/block-editor"
import ServerSideRender from "@wordpress/server-side-render"

export function blockEditRenderCallback(name, attributes = {}) {
    return (
        <div className="server-side-wrapper" style={{ pointerEvents: "none" }}>
            <ServerSideRender block={name} attributes={attributes}/>
        </div>
    ) 
}