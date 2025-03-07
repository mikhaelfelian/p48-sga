<?php

namespace App\Controllers;

use App\Models\StokModel; // Assuming you have a model for Stok

class Stok extends BaseController
{
    public function index()
    {
        // Load the Stok model
        $stokModel = new StokModel();

        // Fetch all stok data
        $data['stok'] = $stokModel->findAll();

        // Load the view and pass the data
        return view('stok/index', $data);
    }

    public function create()
    {
        // Load the form view for creating new stok
        return view('stok/create');
    }

    public function store()
    {
        // Validate and store the new stok data
        $validation = \Config\Services::validation();

        $validation->setRules([
            'name' => 'required',
            'quantity' => 'required|integer',
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $stokModel = new StokModel();
        $stokModel->save([
            'name' => $this->request->getPost('name'),
            'quantity' => $this->request->getPost('quantity'),
        ]);

        return redirect()->to('/stok')->with('success', 'Stok created successfully');
    }

    public function edit($id)
    {
        // Load the Stok model
        $stokModel = new StokModel();

        // Fetch the stok data by ID
        $data['stok'] = $stokModel->find($id);

        // Load the edit view and pass the data
        return view('stok/edit', $data);
    }

    public function update($id)
    {
        // Validate and update the stok data
        $validation = \Config\Services::validation();

        $validation->setRules([
            'name' => 'required',
            'quantity' => 'required|integer',
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $stokModel = new StokModel();
        $stokModel->update($id, [
            'name' => $this->request->getPost('name'),
            'quantity' => $this->request->getPost('quantity'),
        ]);

        return redirect()->to('/stok')->with('success', 'Stok updated successfully');
    }

    public function delete($id)
    {
        // Load the Stok model
        $stokModel = new StokModel();

        // Delete the stok data by ID
        $stokModel->delete($id);

        return redirect()->to('/stok')->with('success', 'Stok deleted successfully');
    }
}
