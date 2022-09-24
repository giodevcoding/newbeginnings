import { useBlockProps, InspectorControls, InnerBlocks } from "@wordpress/block-editor"
import { PanelBody, PanelRow, SelectControl } from "@wordpress/components"
import { blockEditRenderCallback } from "../../gd-blocks/gd-blocks"
import metadata from "./block.json"
import api from "@wordpress/api"
import { useEffect, useState } from "@wordpress/element"

export function NBHeaderEdit(props) {
    const blockProps = useBlockProps();
    const { name } = metadata;

    const [menuList, setMenuList] = useState(new Array());
    
    useEffect(async () => {
        const menuFetch = new api.collections.Menus();
        const response = await menuFetch.fetch({
            data: {}
        });

        const tempArray = Array();
        response.forEach(obj => {
            tempArray[obj.id] = obj.name;
        })
        setMenuList(tempArray);
    }, [props.attributes.selectedMenu]);

    function getSelectedMenu() {
        if (!props.attributes.selectedMenu) {
            return null;
        }
        return props.attributes.selectedMenu;
    }

    function setSelectedMenu(value) {
        props.setAttributes({ selectedMenu: value });
    }

    function getMenuOptions() {
        const options = [{ value: null, label: 'Select a Menu', disabled: true}];
        menuList.forEach((value, key) => {
            options.push({value: key, label: value})
        })
        return options;
    }

    return (
        <div {...blockProps}>
            <InspectorControls>
                <PanelBody title="Select Menu">
                    <PanelRow>
                        <SelectControl 
                                label={ "Select a menu:" }
                                value={getSelectedMenu()}
                                onChange={(value) => setSelectedMenu(value)}
                                options={getMenuOptions()}
                            />
                    </PanelRow>
                </PanelBody>
            </InspectorControls>
            {blockEditRenderCallback(name, props.attributes)}
        </div>
    ) 
}