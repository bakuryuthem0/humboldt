<?php

class ContactController extends BaseController {
	public function getPageContact()
	{
		$title = "Contáctenos | Inversora Humboldt";

		return View::make('contact.index')
		->with('title',$title);
	}
	public function postContact()
	{
		$data = Input::all();
		$rules = array(
			'name' 		=> 'required',
			'email' 	=> 'required|email',
			'subject' 	=> 'required',
			'msg'     	=> 'required',
		);
		$msg = array();
		$attr = array(
			'name' => 'nombre',
			'subject' => 'asunto',
			'msg'	  => 'mensaje',
		);
		$validator = Validator::make($data, $rules, $msg, $attr);

		if ($validator->fails()) {
			return Response::json(array(
				'type' => 'danger',
				'msg'  => $validator->getMessageBag()
			));
		}

		Mail::queue('emails.contact', $data, function($message) use ($data)
		{
			$message->to('inversorahumboldt@gmail.com')->from($data['email'])->subject($data['subject']);
		});

		return Response::json(array(
			'type' => 'success',
			'msg'  => 'Se ha enviado su mensaje satisfactoriamente, pronto nos pondremos en contacto con usted',
		));
	}
	public function getPubContact()
	{
		$data  = Input::all();
		$rules = array(
			'id' 	=> 'required|exists:publications,id',
			'name'  => 'required|min:3|max:45',
			'email' => 'required|email',
			'msg'   => 'required|min:3|max:1000'
		);
		$msg   = array();
		$attr  = array(
			'id' => 'id de la publicación',
			'name'  => 'nombre',
			'email' => 'email',
			'msg'   => 'mensaje'
		); 
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Response::json(array(
				'type' => 'danger',
				'msg'  => $validator->getMessageBag()
			));
		}

		$contact = new Contact;
		$contact->publication_id  = $data['id'];
		$contact->name  		  = $data['name'];
		$contact->email 		  = $data['email'];
		$contact->msg   		  = $data['msg'];
		$contact->save();
		$publication = Publication::find($data['id']);

		$data['subject'] = $data['name']." Esta contactando por la propiedad ".$publication->publication_cod;
		$data['pub_name'] = $publication->title;
		$data['link'] = URL::to('ver-propiedad/'.$data['id']);
		Mail::queue('emails.contact', $data, function($message) use ($data)
		{
			$message->to('inversorahumboldt@gmail.com')->from($data['email'])->subject($data['subject']);
		});

		return Response::json(array(
			'type' => 'success',
			'msg'  => 'Se ha enviado la solicitud, pronto nuestros agentes se pondrán en contacto con usted.'
 		));

	}
	public function getContact()
	{
		$title = "Ver Contactos | Inversora Humboldt, venta, alquiler y remodelaciones de bienes raices.";
		$contact = Contact::with('publication')->orderBy('id','DESCs')->get();
		return View::make('admin.contact.show')
		->with('title',$title)
		->with('contact',$contact);
	}
	public function getUserEmails()
	{
		$title = "Ver Contactos | Inversora Humboldt, venta, alquiler y remodelaciones de bienes raices.";
		$contact = Contact::groupBy('email')->orderBy('id','DESCs')->get();
		return View::make('admin.contact.show')
		->with('title',$title)
		->with('contact',$contact);
	}
}
