// import Editor from '../../../node_modules/@toast-ui/editor';
// import Editor from '/public/node_modules/@toast-ui';
// import Editor from '/public/node_modules/@toast-ui/editor';
// const Editor = require('../../../node_modules/@toast-ui/editor');

export default function markdownEditor() {
    // console.log('Toast UI');
    const editor = new Editor({
        el: document.querySelector('#editor'),
        height: '500px',
        initialEditType: 'markdown',
        previewStyle: 'vertical'
    });

    editor.getMarkdown();
}