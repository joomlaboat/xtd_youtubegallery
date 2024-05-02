import {JoomlaEditor} from 'editor-api';//, JoomlaEditorButton
//import JoomlaDialog from 'joomla.dialog';

window.YG = {

    initialize: function () {
        const o = this.getUriObject(window.self.location.href),
            q = this.getQueryObject(o.query);

        this.frameurl = location.href;

        this.editor = q.e_name;
    },

    close: function () {
        window.parent.Joomla.Modal.getCurrent().close();
    },

    insert: function (videoList, theme) {

        const tag = '{youtubegalleryid=' + videoList + ',' + theme + '}';

        if (window.Joomla.editors) {
            const instances = JoomlaEditor.instances;
            const editorInstance = JoomlaEditor.get('jform_articletext');
            editorInstance.replaceSelection(tag);
            window.parent.Joomla.Modal.getCurrent().close();
        }
        return true;
    },
}
