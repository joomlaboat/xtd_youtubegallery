window.YG = {
    initialize: function () {
        const o = this.getUriObject(window.self.location.href),
            q = this.getQueryObject(o.query);

        this.frameurl = location.href;
        this.editor = q.e_name;
    },

    close: function () {
        if (window.parent.Joomla && window.parent.Joomla.Modal) {
            window.parent.Joomla.Modal.getCurrent().close();
        }
    },

    insert: function (videoList, theme) {
        const tag = '{youtubegalleryid=' + videoList + ',' + theme + '}';

        if (window.Joomla && window.Joomla.editors) {
            let editorInstance;

            if (typeof JoomlaEditor !== "undefined" && JoomlaEditor.get) {
                // Joomla 5
                editorInstance = JoomlaEditor.get('jform_articletext');
            } else if (window.Joomla.editors.instances) {
                // Joomla 4
                editorInstance = window.Joomla.editors.instances['jform_articletext'];
            }

            if (editorInstance) {
                editorInstance.replaceSelection(tag);
                this.close();
            }
        }
        return true;
    },
};
