import { JSXBlockEdit as edit } from "./edit";
import { JSXBlock as save } from "./save";
import { blockEditRenderCallback } from "../../gd-blocks/gd-blocks";
import metadata from './block.json'

import "./render.scss";
import "./editor.scss";

const { name } = metadata;

const settings = {
    apiVersion: 2,
    //example: {}
    edit,
    save //Or use blockEditRenderCallback(name)
}

wp.blocks.registerBlockType( { name, ...metadata }, settings);
