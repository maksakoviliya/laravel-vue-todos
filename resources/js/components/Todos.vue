<template>
  <div>
    <div class="card">
      <div class="card-header">
        <h3 class="text-center card-title: this.newTodo">Списки дел</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col">
            <div class="card w-100">
              <div class="card-header">
                <h4 class="text-center">Активные задачи</h4>
              </div>
              <div class="card-body">

                <div class="card mb-2" v-for="todo in todos" :key="todo.id">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <p class="mb-0">{{todo.body}}</p>
                      </div>
                      <div class="col-3">
                        <div class="d-flex">
                          <button class="btn btn-sm btn-success d-inline-flex align-items-center justify-content-center mr-2"
                                  @click="done(todo.id)">
                            <i class="material-icons">check_circle_outline</i>
                          </button>
                          <button class="btn btn-sm btn-danger d-inline-flex align-items-center justify-content-center" 
                                  @click="remove(todo.id)">
                            <i class="material-icons">delete_forever</i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-12">
                        <div class="d-flex">
                          <div class="form-group mb-0 w-100">
                            <input type="text" class="form-control" v-model="newTodo">
                          </div>
                            <button class="btn btn-sm btn-success d-inline-flex align-items-center justify-content-center ml-2"
                                    @click = "create">
                              <i class="material-icons">add</i>
                            </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card w-100">
              <div class="card-header">
                <h4 class="text-center">Выполненые задачи</h4>
              </div>
              <div class="card-body">
                <div class="card mb-2" v-for="todo in doneTodos" :key="todo.id">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <p class="mb-0">{{todo.body}}</p>
                      </div>
                      <div class="col-3">
                        <div class="d-flex">
                          <button class="btn btn-sm btn-info d-inline-flex align-items-center justify-content-center mr-2"
                          @click="cancel(todo.id)">
                            <i class="material-icons">keyboard_backspace</i>
                          </button>
                          <button class="btn btn-sm btn-danger d-inline-flex align-items-center justify-content-center" 
                                  @click="remove(todo.id)">
                            <i class="material-icons">delete_forever</i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      todos: [],
      newTodo: '',
      doneTodos: []
    }
  },
  mounted () {
    this.fetch()
  },
  methods: {
    create() {
      if (this.newTodo) {
        axios.post('api/todos/create', {
          body: this.newTodo
        })
        .then((response) => {
          this.fetch()
          this.newTodo = ''
        })
        .catch(function (error) {
          console.log(error);
        });
      }
    },
    fetch() {
      axios.post('api/todos')
      .then((response) => {
        this.todos = response.data.todos
        this.doneTodos = response.data.doneTodos
        // console.log(this.todos);
      })
      .catch(function (error) {
        console.log(error);
      });
    },
    remove(id) {
      axios.post('api/todos/remove', {
        'id': id
      })
      .then((response) => {
        this.fetch()
      })
      .catch(function (error) {
        console.log(error);
      });
    },
    done(id) {
      axios.post('api/todos/done', {
        'id': id
      })
      .then((response) => {
        this.fetch()
      })
      .catch(function (error) {
        console.log(error);
      });
    },
    cancel(id) {
      axios.post('api/todos/cancel', {
        'id': id
      })
      .then((response) => {
        this.fetch()
      })
      .catch(function (error) {
        console.log(error);
      });
    },

  }
}
</script>
