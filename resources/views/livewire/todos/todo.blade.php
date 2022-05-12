<div>
    <div x-data="data()" x-init="ordenar()">
        <x-card class="container mt-5">

            @slot('title')
                Total tareas <span x-text="totalTareas"></span>
            @endslot

            <label>Buscar </label>
            <x-jet-input type="text" x-model="search" />
            <form wire:submit.prevent="save()" class="flex gap-2 mt-2">
                <label class="mt-2">
                    Crear
                </label>
                <x-jet-input type="text" wire:model="task" />
                <x-jet-button type="submit">Agregar</x-jet-button>
            </form>
            <ul x-ref="items" class="my-3">
                <template x-for="t in filterTodo()">
                    <li class="border py-3 px-4 mt-2" :id="t.id" :count="t.count">
                        <input @change="status(t)" type="checkbox" x-model="t.status" :checked="t.status == 1">
                        <span @click="t.editMode=true" x-show="!t.editMode" x-text="t.name"></span>
                        <input @keyup.enter="t.editMode=false; $wire.emit('update',t)" type="text" x-show="t.editMode"
                            x-model="t.name">
                        <button class="float-right" @click="remove(t)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </li>
                </template>
            </ul>
            <div class="flex flex-row-reverse">
                <x-jet-danger-button @click="todos = []; $wire.emit('delete')">Borrar to do</x-jet-danger-button>
            </div>
        </x-card>
    </div>
    <script>
        function data() {
            return {

                search: "",
                task: '',
                //todos: Alpine.$persist(@entangle('todos')),
                todos: @entangle('todos'), // ordenacion 1 y 2
                //todos: @json($todos), // ordenacion 3
                ordenar() {
                    Sortable.create(this.$refs.items, {
                        onEnd: (event) => {

                            // *** ordenacion 1 ineficiente
                            // var todosAux = []
                            // document.querySelectorAll(".list-group li").forEach(todoHTML => {
                            //     this.todos.forEach(todo => {
                            //         if (todo.id == todoHTML.id)
                            //             todosAux.push(todo)
                            //     })
                            // });
                            // console.log(todosAux)
                            // this.todos = todosAux
                            // Livewire.emit("setOrden")
                            // *** ordenacion 1 ineficiente

                            // *** ordenacion 2
                            // var t = this.todos[event.oldIndex]
                            // this.todos.splice(event.oldIndex, 1)
                            // this.todos.splice(event.newIndex, 0, t)
                            // Livewire.emit("setOrden")
                            // *** ordenacion 2

                            // *** ordenacion 3 por PKs
                            var ids = []
                            document.querySelectorAll(".list-group li").forEach(todoHTML => {
                                ids.push(todoHTML.id)
                            });

                            axios.post('/todo/re-orden', {
                                ids
                            })
                            //Livewire.emit("setOrdenById", ids)
                            // *** ordenacion 3 por PKs
                        }
                    })
                },
                completed(todo) {
                    return todo.completed
                },
                incompleted(todo) {
                    return !todo.completed
                },
                totalTareas() {
                    return this.todos.length
                },
                filterTodo() {
                    console.log(this.todos)
                    return this.todos.filter((t) => t.name.toLowerCase().includes(this.search.toLowerCase()))
                },
                remove(todo) {
                    this.todos = this.todos.filter((t) => t != todo)
                    Livewire.emit("delete", todo.id)
                },
                status(todo) {
                    Livewire.emit("status", todo.id, todo.status)
                },
                save() {
                    this.todos.push({
                        completed: false,
                        task: this.task
                    })
                    this.task = ""
                }
            }
        }
    </script>


</div>
