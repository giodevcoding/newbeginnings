import { NBHeaderEdit as edit } from "./edit";
import metadata from "./block.json"

import "./render.scss"
import "./editor.scss"

const { name, attributes } = metadata;

const settings = {
    apiVersion: 2,
    attributes,
    edit,
    save: props => null
}

wp.blocks.registerBlockType( { name, ...metadata }, settings);