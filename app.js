$(function () {
    $('#main').children().hide();

    updateView();

    $('#add-project').click(function () {
        clearProjectForm();
        showAddProjectForm();
    });

    $('#add-task').click(function () {
        showAddTaskForm();
    });

    $('#project-form').submit(addProject);
    $('#task-form').submit(addTask);
});

function updateView() {
    loadProjects();
}

function loadProjects() {
    $('#project-list').children().remove();
    $('form#task-form select').children().remove();

    $.getJSON('api.php/project', function (projects) {
        for (var i in projects) {
            var project = projects[i];
            appendProjectToList(project);
            appendProjectToTaskForm(project);
        }

        loadTasks();
    })
    .error(function(jqXHR, err) {
        console.log(err);
    });
}

function loadTasks(){
    $.getJSON('api.php/task', function (tasks) {
        for (var i in tasks) {
            var task = tasks[i];
            appendTaskToList(task);
        }
    })
    .error(function(jqXHR, err) {
        console.log(err);
    });
}

function appendProjectToList(project) {
    $('#project-list').append(
        '<li id="project' + project.id +'">'
        +   project.title
        +   ' <a href="#" data-action="delete">delete</a>'
        +   ' <a href="#" data-action="edit">edit</a>'
        +'</li>');

    $('#project' + project.id).click(function () {
        showProject(project);
    });

    $('#project' + project.id + " a[data-action=delete]").click(function (event) {
        event.stopPropagation();
        deleteProject(project.id);
    });

    $('#project' + project.id + " a[data-action=edit]").click(function (event) {
        event.stopPropagation();
        editProject(project);
    });
}

function appendTaskToList(task) {
    $('#project' + task.projectId).not(':has(ul)').append('<ul></ul>')
    $('#project' + task.projectId + ' ul').append('<li id="task'+task.id+'">'+task.title+'</li>');
    $('#task' + task.id).click(function (event) {
        event.stopPropagation();
        showTask(task);
    });
}

function appendProjectToTaskForm(project) {
    $('form#task-form select').append(
        '<option value="' + project.id + '">'
        +   project.title
        +'</option>'
    );
}

function showProject(project) {
    $('#main').children().hide();
    $('#project-view h3').html(project.title);
    $('#project-view p').html(project.description);
    $('#project-view').show();
}

function deleteProject(id) {
    $.ajax({
        url: 'api.php/project/' + id,
        type: 'delete',
        dataType: 'json'
     })
     .success(function () {
         updateView();
     })
     .error(function (jqXHR, err) {
         console.log(err);
     });
}

function editProject(project) {
    $('#project-id').val(project.id);
    $('#project-title').val(project.title);
    $('#project-desc').val(project.description);
    showAddProjectForm();
}

function showTask(task) {
    $('#main').children().hide();
    $('#task-view h3').html(task.title);
    $('#task-view p').html(task.description);
    $('#task-view').show();
}

function showAddProjectForm() {
    $('#main').children().hide();
    $('#project-form-container').show();
}

function showAddTaskForm() {
    $('#main').children().hide();
    $('#task-form-container').show();
}

function addProject(event) {
    event.preventDefault();

    var method = $('#project-id').val()? 'put' : 'post';

    $.ajax({
        url: 'api.php/project',
        type: method,
        dataType: 'json',
        data: $('form#project-form').serialize()
     })
     .success(function () {
         updateView();
     })
     .error(function (jqXHR, err) {
         console.log(err);
     })
     .complete(function () {
         clearProjectForm();
     });
}

function addTask(event) {
    event.preventDefault();

    $.ajax({
        url: 'api.php/task',
        type: 'post',
        dataType: 'json',
        data: $('form#task-form').serialize()
     })
     .success(function () {
         updateView();
     })
     .error(function (jqXHR, err) {
         console.log(err);
     })
     .complete(function () {
         $('form#task-form input[type=text]').val('');
         $('form#project-form input[type=hidden]').val('');
     });
}

function clearProjectForm() {
    $('form#project-form input[type=text]').val('');
    $('form#project-form input[type=hidden]').val('');
}
