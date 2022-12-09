<?php

namespace App\Controllers;

use App\Helpers\HashMap;
use App\Models\TodoModel;

use App\Helpers\Response;
use Exception;

class Todo extends BaseController
{
    // view
    public function index()
    {
        $todoModel = new TodoModel();
        try {
            $data = $todoModel->findAll();
            $res = Response::responseHelper('get-all', $data, false, 'success');
            return view('index', $res);
        } catch (\Throwable $th) {
            //throw $th;
            $res = Response::responseHelper('get-all', null, true, $th->getMessage());
            return view('index', $res);
        }
    }

    public function detail($id)
    {
        $res = [];
        $todoModel = new TodoModel();

        try {
            $data = $todoModel->find($id);
            $res = Response::responseHelper('get-detail', $data, false, 'success');
        } catch (Exception $e) {
            $res = Response::responseHelper('get-detail', null, true, $e->getMessage());
        }

        return view('detail', $res);
    }

    // POST
    public function create()
    {
        $req = $this->request->getPost();
        $payload = [
            'title' => $req['title'],
            'description' => $req['description'],
            'isDone' => false
        ];

        $todoModel = new TodoModel();
        if ($todoModel->insert($payload, false) == false) {
            Response::setFlashData('create', null, true, $todoModel->errors());
            return redirect('home');
        }
        Response::setFlashData('create', null, false, "success created");
        return redirect('home');
    }

    // POST
    public function update($id)
    {
        $req = $this->request->getPost();
        $payload = [
            'title' => $req['title'],
            'description' => $req['description']
        ];

        $todoModel = new TodoModel();
        if ($todoModel->update($id, $payload) == false) {
            Response::setFlashData('update', null, true, $todoModel->errors());
            return redirect()->to('detail/' . $id);
        }
        Response::setFlashData('update', null, false, "success updated");
        return redirect()->to('detail/' . $id);
    }

    // POST
    public function toggleIsDone($id)
    {
        $hashMap = new HashMap();
        $todoModel = new TodoModel();

        $hashMap->put('t', true);
        $hashMap->put('f', false);

        $req = $this->request->getPost();
        $isDone = $req['isDone'];
        if ($hashMap->get($isDone)) {
            $isDone = false;
        } else {
            $isDone = true;
        }

        $success = $todoModel->skipValidation(true)
            ->update($id, ['isDone' => $isDone]);
        if ($success == false) {
            Response::setFlashData('update-isDone', null, true, $todoModel->errors());
            return redirect()->to('home');
        }
        Response::setFlashData('update-isDone', null, false, "success");
        return redirect('home');
    }

    // POST
    public function delete($id)
    {
        $todoModel = new TodoModel();
        if (!$todoModel->delete($id)) {
            Response::setFlashData('delete', null, true, $todoModel->errors());
            return redirect()->to('home');
        }
        Response::setFlashData('delete', null, false, "success");
        return redirect('home');
    }
}
