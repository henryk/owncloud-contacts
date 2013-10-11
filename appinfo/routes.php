<?php
/**
 * @author Thomas Tanghus
 * Copyright (c) 2013 Thomas Tanghus (thomas@tanghus.net)
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */
namespace OCA\Contacts;

use OCA\Contacts\Dispatcher;

//define the routes
//for the index
$this->create('contacts_index', '/')
	->actionInclude('contacts/index.php');
// 	->action(
// 		function($params){
// 			//
// 		}
// 	);

$this->create('contacts_jsconfig', 'ajax/config.js')
	->actionInclude('contacts/js/config.php');

/* TODO: Check what it requires to be a RESTful API. I think maybe {user}
	shouldn't be in the URI but be authenticated in headers or elsewhere.
*/
$this->create('contacts_address_books_for_user', 'addressbooks/')
	->get()
	->action(
		function($params) {
			session_write_close();
			$dispatcher = new Dispatcher($params);
			$dispatcher->dispatch('AddressBookController', 'userAddressBooks', $params);
		}
	);

$this->create('contacts_address_book_add', 'addressbook/{backend}/add')
	->post()
	->action(
		function($params) {
			session_write_close();
			$dispatcher = new Dispatcher($params);
			$dispatcher->dispatch('AddressBookController', 'addAddressBook', $params);
		}
	)
	->requirements(array('backend'));

$this->create('contacts_address_book', 'addressbook/{backend}/{addressBookId}')
	->get()
	->action(
		function($params) {
			session_write_close();
			$dispatcher = new Dispatcher($params);
			$dispatcher->dispatch('AddressBookController', 'getAddressBook', $params);
		}
	)
	->requirements(array('backend', 'addressBookId'));

$this->create('contacts_address_book_update', 'addressbook/{backend}/{addressBookId}')
	->post()
	->action(
		function($params) {
			session_write_close();
			$dispatcher = new Dispatcher($params);
			$dispatcher->dispatch('AddressBookController', 'updateAddressBook', $params);
		}
	)
	->requirements(array('backend', 'addressBookId'));

$this->create('contacts_address_book_delete', 'addressbook/{backend}/{addressBookId}')
	->delete()
	->action(
		function($params) {
			$dispatcher = new Dispatcher($params);
			session_write_close();
			$dispatcher->dispatch('AddressBookController', 'deleteAddressBook', $params);
		}
	)
	->requirements(array('backend', 'addressBookId'));

$this->create('contacts_address_book_activate', 'addressbook/{backend}/{addressBookId}/activate')
	->post()
	->action(
		function($params) {
			session_write_close();
			$dispatcher = new Dispatcher($params);
			$dispatcher->dispatch('AddressBookController', 'activateAddressBook', $params);
		}
	)
	->requirements(array('backend', 'addressBookId'));

$this->create('contacts_address_book_add_contact', 'addressbook/{backend}/{addressBookId}/contact/add')
	->post()
	->action(
		function($params) {
			session_write_close();
			$dispatcher = new Dispatcher($params);
			$dispatcher->dispatch('AddressBookController', 'addChild', $params);
		}
	)
	->requirements(array('backend', 'addressBookId'));

$this->create('contacts_address_book_delete_contact', 'addressbook/{backend}/{addressBookId}/contact/{contactId}')
	->delete()
	->action(
		function($params) {
			session_write_close();
			$dispatcher = new Dispatcher($params);
			$dispatcher->dispatch('AddressBookController', 'deleteChild', $params);
		}
	)
	->requirements(array('backend', 'addressBookId', 'contactId'));

$this->create('contacts_address_book_delete_contacts', 'addressbook/{backend}/{addressBookId}/deleteContacts')
	->post()
	->action(
		function($params) {
			session_write_close();
			$dispatcher = new Dispatcher($params);
			$dispatcher->dispatch('AddressBookController', 'deleteChildren', $params);
		}
	)
	->requirements(array('backend', 'addressBookId', 'contactId'));

$this->create('contacts_address_book_move_contact', 'addressbook/{backend}/{addressBookId}/contact/{contactId}')
	->post()
	->action(
		function($params) {
			session_write_close();
			$dispatcher = new Dispatcher($params);
			$dispatcher->dispatch('AddressBookController', 'moveChild', $params);
		}
	)
	->requirements(array('backend', 'addressBookId', 'contactId'));

$this->create('contacts_import_upload', 'addressbook/{backend}/{addressBookId}/import/upload')
	->post()
	->action(
		function($params) {
			session_write_close();
			$dispatcher = new Dispatcher($params);
			$dispatcher->dispatch('ImportController', 'upload', $params);
		}
	)
	->requirements(array('backend', 'addressBookId'));

$this->create('contacts_import_prepare', 'addressbook/{backend}/{addressBookId}/import/prepare')
	->post()
	->action(
		function($params) {
			session_write_close();
			$dispatcher = new Dispatcher($params);
			$dispatcher->dispatch('ImportController', 'prepare', $params);
		}
	)
	->requirements(array('backend', 'addressBookId'));

$this->create('contacts_import_start', 'addressbook/{backend}/{addressBookId}/import/start')
	->post()
	->action(
		function($params) {
			session_write_close();
			$dispatcher = new Dispatcher($params);
			$dispatcher->dispatch('ImportController', 'start', $params);
		}
	)
	->requirements(array('backend', 'addressBookId'));

$this->create('contacts_import_status', 'addressbook/{backend}/{addressBookId}/import/status')
	->get()
	->action(
		function($params) {
			session_write_close();
			$dispatcher = new Dispatcher($params);
			$dispatcher->dispatch('ImportController', 'status', $params);
		}
	)
	->requirements(array('backend', 'addressBookId'));

$this->create('contacts_address_book_export', 'addressbook/{backend}/{addressBookId}/export')
	->get()
	->action(
		function($params) {
			session_write_close();
			$dispatcher = new Dispatcher($params);
			$dispatcher->dispatch('ExportController', 'exportAddressBook', $params);
		}
	)
	->requirements(array('backend', 'addressBookId'));

$this->create('contacts_contact_export', 'addressbook/{backend}/{addressBookId}/contact/{contactId}/export')
	->get()
	->action(
		function($params) {
			session_write_close();
			$dispatcher = new Dispatcher($params);
			$dispatcher->dispatch('ExportController', 'exportContact', $params);
		}
	)
	->requirements(array('backend', 'addressbook', 'contactId'));

$this->create('contacts_export_selected', 'exportSelected')
	->get()
	->action(
		function($params) {
			session_write_close();
			$dispatcher = new Dispatcher($params);
			$dispatcher->dispatch('ExportController', 'exportSelected', $params);
		}
	);

$this->create('contacts_contact_photo', 'addressbook/{backend}/{addressBookId}/contact/{contactId}/photo')
	->get()
	->action(
		function($params) {
			session_write_close();
			$dispatcher = new Dispatcher($params);
			$dispatcher->dispatch('ContactPhotoController', 'getPhoto', $params);
		}
	)
	->requirements(array('backend', 'addressbook', 'contactId'));

$this->create('contacts_upload_contact_photo', 'addressbook/{backend}/{addressBookId}/contact/{contactId}/photo')
	->post()
	->action(
		function($params) {
			session_write_close();
			$dispatcher = new Dispatcher($params);
			$dispatcher->dispatch('ContactPhotoController', 'uploadPhoto', $params);
		}
	)
	->requirements(array('backend', 'addressbook', 'contactId'));

$this->create('contacts_cache_contact_photo', 'addressbook/{backend}/{addressBookId}/contact/{contactId}/photo/cacheCurrent')
	->get()
	->action(
		function($params) {
			session_write_close();
			$dispatcher = new Dispatcher($params);
			$dispatcher->dispatch('ContactPhotoController', 'cacheCurrentPhoto', $params);
		}
	)
	->requirements(array('backend', 'addressbook', 'contactId'));

$this->create('contacts_cache_fs_photo', 'addressbook/{backend}/{addressBookId}/contact/{contactId}/photo/cacheFS')
	->get()
	->action(
		function($params) {
			session_write_close();
			$dispatcher = new Dispatcher($params);
			$dispatcher->dispatch('ContactPhotoController', 'cacheFileSystemPhoto', $params);
		}
	)
	->requirements(array('backend', 'addressbook', 'contactId'));

$this->create('contacts_tmp_contact_photo', 'addressbook/{backend}/{addressBookId}/contact/{contactId}/photo/{key}/tmp')
	->get()
	->action(
		function($params) {
			session_write_close();
			$dispatcher = new Dispatcher($params);
			$dispatcher->dispatch('ContactPhotoController', 'getTempPhoto', $params);
		}
	)
	->requirements(array('backend', 'addressbook', 'contactId', 'key'));

$this->create('contacts_crop_contact_photo', 'addressbook/{backend}/{addressBookId}/contact/{contactId}/photo/{key}/crop')
	->post()
	->action(
		function($params) {
			session_write_close();
			$dispatcher = new Dispatcher($params);
			$dispatcher->dispatch('ContactPhotoController', 'cropPhoto', $params);
		}
	)
	->requirements(array('backend', 'addressbook', 'contactId', 'key'));

// Save or delete a single property.
$this->create('contacts_contact_patch', 'addressbook/{backend}/{addressBookId}/contact/{contactId}')
	->patch()
	->action(
		function($params) {
			session_write_close();
			$dispatcher = new Dispatcher($params);
			$dispatcher->dispatch('ContactController', 'patch', $params);
		}
	)
	->requirements(array('backend', 'addressbook', 'contactId'));

$this->create('contacts_contact_get', 'addressbook/{backend}/{addressBookId}/contact/{contactId}/')
	->get()
	->action(
		function($params) {
			session_write_close();
			$dispatcher = new Dispatcher($params);
			$dispatcher->dispatch('ContactController', 'getContact', $params);
		}
	)
	->requirements(array('backend', 'addressbook', 'contactId'));

// Save all properties. Used for merging contacts.
$this->create('contacts_contact_save_all', 'addressbook/{backend}/{addressBookId}/contact/{contactId}/save')
	->post()
	->action(
		function($params) {
			session_write_close();
			$dispatcher = new Dispatcher($params);
			$dispatcher->dispatch('ContactController', 'saveContact', $params);
		}
	)
	->requirements(array('backend', 'addressbook', 'contactId'));

$this->create('contacts_categories_list', 'groups/')
	->get()
	->action(
		function($params) {
			session_write_close();
			$dispatcher = new Dispatcher($params);
			$dispatcher->dispatch('GroupController', 'getGroups', $params);
		}
	);

$this->create('contacts_categories_add', 'groups/add')
	->post()
	->action(
		function($params) {
			session_write_close();
			$dispatcher = new Dispatcher($params);
			$dispatcher->dispatch('GroupController', 'addGroup', $params);
		}
	);

$this->create('contacts_categories_delete', 'groups/delete')
	->post()
	->action(
		function($params) {
			session_write_close();
			$dispatcher = new Dispatcher($params);
			$dispatcher->dispatch('GroupController', 'deleteGroup', $params);
		}
	);

$this->create('contacts_categories_rename', 'groups/rename')
	->post()
	->action(
		function($params) {
			session_write_close();
			$dispatcher = new Dispatcher($params);
			$dispatcher->dispatch('GroupController', 'renameGroup', $params);
		}
	);

$this->create('contacts_categories_addto', 'groups/addto/{categoryId}')
	->post()
	->action(
		function($params) {
			session_write_close();
			$dispatcher = new Dispatcher($params);
			$dispatcher->dispatch('GroupController', 'addToGroup', $params);
		}
	);

$this->create('contacts_categories_removefrom', 'groups/removefrom/{categoryId}')
	->post()
	->action(
		function($params) {
			session_write_close();
			$dispatcher = new Dispatcher($params);
			$dispatcher->dispatch('GroupController', 'removeFromGroup', $params);
		}
	)
	->requirements(array('categoryId'));

$this->create('contacts_setpreference', 'preference/set')
	->post()
	->action(
		function($params) {
			session_write_close();
			$dispatcher = new Dispatcher($params);
			$dispatcher->dispatch('SettingsController', 'set');
		}
	);

$this->create('contacts_index_properties', 'indexproperties/{user}/')
	->post()
	->action(
		function($params) {
			session_write_close();
			// TODO: Add BackgroundJob for this.
			\OCP\Util::emitHook('OCA\Contacts', 'indexProperties', array());

			\OCP\Config::setUserValue($params['user'], 'contacts', 'contacts_properties_indexed', 'yes');
			\OCP\JSON::success(array('isIndexed' => true));
		}
	)
	->requirements(array('user'))
	->defaults(array('user' => \OCP\User::getUser()));

