<div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="container mt-5" style="max-width: 500px;">

        <div class="card">
            <div x-data="data()" x-init="ordenar()">
                <div class="card-header">
                    <h4>Total tareas <span x-text="totalTareas"></span></h4>
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-auto">
                            <label class="form-control-plaintext">Buscar </label>
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" x-model="search">
                        </div>
                    </div>
                    <form wire:submit.prevent="save()" class="row g-3 mt-2">
                        <div class="col-auto">

                            <label class="form-control-plaintext">
                                Crear
                            </label>
                        </div>
                        <div class="col-auto">
                            <input class="form-control" type="text" wire:model="task">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-success">Agregar</button>
                        </div>
                    </form>

                    @foreach ($todos as $t)
                    @endforeach

                    <ul x-ref="items" class="list-group my-3">
                        <template x-for="t in filterTodo()">
                            <li class="list-group-item" :id="t.id" :count="t.count">
                                <input @change="status(t)" type="checkbox" x-model="t.status" :checked="t.status == 1">
                                <span @click="t.editMode=true" x-show="!t.editMode" x-text="t.name"></span>
                                <input @keyup.enter="t.editMode=false; $wire.emit('update',t)" type="text"
                                    x-show="t.editMode" x-model="t.name">
                                <button class="btn btn-sm float-end btn-close" @click="remove(t)"></button>
                            </li>
                        </template>
                    </ul>
                    <button class="btn btn-danger" @click="todos = []; $wire.emit('delete')">Borrar to do</button>
                </div>
            </div>
        </div>
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
