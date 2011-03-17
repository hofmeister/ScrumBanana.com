<?php
class ProjectController extends Controller {
    public function index() {
        //Do nothing really... all is loaded ajax
    }

    public function listAll() {
        $projects = ProjectService::listAll();
        $this->asJson($projects);
    }
    public function add() {
        $this->validate(array(
            'name'=>'required,min(4)'
        ));
        $projectDoc = ProjectService::save(Request::post()->get('name'));
        $this->asJson($projectDoc);
    }
    public function update() {
        $project = $this->fromJson('project');
        $projectDoc = ProjectService::save($project);
        $this->asJson($projectDoc);
    }
    public function delete() {
        if (ProjectService::delete(Request::get('id'))) {
            MessageHandler::instance()->addMessage('Deleted project');
            $this->asJson(true);
        } else {
            MessageHandler::instance()->addError('Could not delete project');
            $this->asJson(false);
        }

    }
    public function get() {
        $project = ProjectService::get(Request::get('id'));
        if ($project) {
            $this->asJson($project);
        } else {
            $this->asJson(false);
        }
    }
}