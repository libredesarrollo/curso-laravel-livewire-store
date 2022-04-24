require('./bootstrap');

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

import toast from 'toast-me';
window.toast = toast

const options = {
    position:'bottom'
}

Livewire.on('itemAdd', (post) =>{
    toast("Item agredado exitosamente! "+post.title, options)
})
Livewire.on('itemChange', (post) =>{
    toast("Item modificado exitosamente! "+post.title, options)
})
Livewire.on('itemDelete', () =>{
    toast("Item elimado :(", 'error')
})
