<script src="https://cdn.tiny.cloud/1/{{ config('app.tinymce_key') }}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  let saveTimeout;

  tinymce.init({
    selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
    plugins: 'code table lists',
    toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
    disabled: true,
    content_css: 'https://unpkg.com/style.css',
    content_style: "* { margin: 0; padding: 0; font-family: 'Instrument Sans', sans-serif; word-break: break-word; overflow-wrap: anywhere; hyphens: auto;} body { padding: 2rem;}",
    setup: function (editor) {
      editor.on('keydown', (e) => {
        const validKeys = (
          e.key.length === 1 ||
          e.key === 'Backspace' ||
          e.key === 'Delete'
        );

        if (e.ctrlKey || e.metaKey || e.altKey || !validKeys) {
          return;
        }

        // Clear any previous timeout to debounce
        clearTimeout(saveTimeout);

        // Dispatch 'saving' immediately
        Livewire.dispatch('saving');

        // Debounce the actual save + 'saved' dispatch
        saveTimeout = setTimeout(() => {
          saveContentToLivewire();
          Livewire.dispatch('saved');
        }, 1000); // Save 1 second after last keypress
      })
    } 
  });

  setTimeout(() => {
    document.querySelector('#myeditorinstance').addEventListener('keydown', () => {
      // saveContentToLivewire();
      console.log('saved');
    }); 

  }, 5000)

  function setDisabled(val) {
    tinymce.activeEditor.options.set('disabled', val);
  }

  function setTinyMCEContent(content) {
    tinymce.activeEditor.setContent(content);
  }

  function setTinyMCEContentFromEl(e) {
    const encoded = e.getAttribute('data-content');
    const html = atob(encoded); // decode base64
    setTinyMCEContent(html);
  }
  
  function getTinyMCEContent() {
    return tinymce.activeEditor.getContent();
  }

  function saveContentToLivewire() {
    document.getElementById('editorContent').value = getTinyMCEContent();
    document.getElementById('editorContent').dispatchEvent(new Event('input'));
    Livewire.dispatch('saveContent');
  }
</script>