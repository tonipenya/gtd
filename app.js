$(function () {
    $('#main').children().hide();

    loadProjects();

    $('#add-project').click(function () {
        showAddProjectForm();
    });

    $('#add-task').click(function () {
        showAddTaskForm();
    });

    $('#project-form').submit(addProject);
    $('#task-form').submit(addTask);
});

function loadProjects() {
    $('project-list').children().remove();
    $('form#task-form select').children().remove();

    $.getJSON('api/project.php', function (projects) {
        for (var i in projects) {
            var project = projects[i];
            appendProjectToList(project);
            appendProjectToTaskForm(project);
        }

        loadTasks();
    })
    .fail(function(jqXHR, err) {
        console.log(err);
    });
}

function loadTasks(){
    $.getJSON('api/task.php', function (tasks) {
        for (var i in tasks) {
            var task = tasks[i];
            appendTaskToList(task);
        }
    })
    .fail(function(jqXHR, err) {
        console.log(err);
    });
}

function appendProjectToList(project) {
    $('#project-list').append(
        '<li id="project' + project.id +'">'
        +   project.title
        +   '<a href="#" >-</a>'
        +'</li>');

    $('#project' + project.id).click(function () {
        showProject(project);
    });

    $('#project' + project.id + " a").click(function (event) {
        event.stopPropagation();
        deleteProject(project.id);
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
    console.log('appending');
    $('form#task-form select').append(
        '<option value="' + project.id + '">'
        +   project.title
        +'</option>'
    );
}

function showProject(project) {
    $('#main').children().hide();
    $('#project-view').show();
    $('#project-view h2').html(project.title);
    $('#project-view p').html(project.description);

}

function deleteProject(id) {
    console.log('deleting ' + id);
    $.ajax({
        url: 'api/project.php',
        type: 'delete',
        dataType: 'json',
        data: $('form#project-form').serialize()
     })
     .fail(function (jqXHR, err) {
         console.log(err);
     });
}

function showTask(task) {
    $('#main').children().hide();
    $('#task-view').show();
    $('#task-view h2').html(task.title);
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

    $.ajax({
        url: 'api/project.php',
        type: 'post',
        dataType: 'json',
        data: $('form#project-form').serialize()
     })
     .fail(function (jqXHR, err) {
         console.log(err);
     });

}

function addTask(event) {
    event.preventDefault();

    $.ajax({
        url: 'api/task.php',
        type: 'post',
        dataType: 'json',
        data: $('form#task-form').serialize()
     })
     .fail(function (jqXHR, err) {
         console.log(err);
     });

}
