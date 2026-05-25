import Alpine from 'alpinejs';
import { Editor } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import Image from '@tiptap/extension-image';
import Link from '@tiptap/extension-link';
import Underline from '@tiptap/extension-underline';

window.Alpine = Alpine;

window.richEditor = function (initialContent = '') {
    return {
        editor: null,
        content: initialContent,
        _syncTimer: null,

        _getHiddenTextarea() {
            return document.getElementById('editor-content-hidden');
        },

        _syncToLivewire(html) {
            const textarea = this._getHiddenTextarea();
            if (textarea) {
                textarea.value = html;
                textarea.dispatchEvent(new Event('input', { bubbles: true }));
            }
        },

        init() {
            const self = this;

            this.$nextTick(() => {
                const formRoot = this.$el;
                const container = formRoot.querySelector('[x-ref="editorEl"]');
                if (!container) return;

                // Sync initial content
                this._syncToLivewire(initialContent);

                this.editor = new Editor({
                    element: container,
                    content: initialContent,
                    extensions: [
                        StarterKit.configure({ heading: { levels: [1, 2, 3] } }),
                        Underline,
                        Image.configure({ inline: false, allowBase64: true }),
                        Link.configure({ openOnClick: false }),
                    ],
                    onUpdate({ editor }) {
                        const html = editor.getHTML();
                        self.content = html;
                        self._syncToLivewire(html);
                    },
                });
            });
        },

        destroy() {
            this.editor?.destroy();
            this.editor = null;
        },

        isActive(type, opts = {}) {
            return this.editor?.isActive(type, opts) ?? false;
        },

        toggleBold() { this.editor?.chain().focus().toggleBold().run(); },
        toggleItalic() { this.editor?.chain().focus().toggleItalic().run(); },
        toggleUnderline() { this.editor?.chain().focus().toggleUnderline().run(); },
        toggleStrike() { this.editor?.chain().focus().toggleStrike().run(); },
        toggleCodeBlock() { this.editor?.chain().focus().toggleCodeBlock().run(); },
        toggleBlockquote() { this.editor?.chain().focus().toggleBlockquote().run(); },
        toggleBulletList() { this.editor?.chain().focus().toggleBulletList().run(); },
        toggleOrderedList() { this.editor?.chain().focus().toggleOrderedList().run(); },
        toggleHorizontalRule() { this.editor?.chain().focus().setHorizontalRule().run(); },
        setHeading(level) { this.editor?.chain().focus().toggleHeading({ level }).run(); },
        undo() { this.editor?.chain().focus().undo().run(); },
        redo() { this.editor?.chain().focus().redo().run(); },

        insertImageDialog() {
            const url = prompt('Masukkan URL gambar:');
            if (url) {
                this.editor?.chain().focus().setImage({ src: url }).run();
            }
        },

        insertLinkDialog() {
            const url = prompt('Masukkan URL link:');
            if (url) {
                this.editor?.chain().focus().setLink({ href: url, target: '_blank' }).run();
            }
        },

        setContent(html) {
            if (this.editor && html !== this.editor.getHTML()) {
                this.editor.commands.setContent(html);
                this.content = html;
                this._syncToLivewire(html);
            }
        },
    };
};

Alpine.start();
window.AlpineInstance = Alpine;
