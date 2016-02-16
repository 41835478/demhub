<?php

namespace App\Http\Components;

use Weblee\Mandrill\Mail;
use File;

/**
 * Global email helper used with Mandrill.
 */
class Emailer
{
	public static function sendWelcomeEmail(User $user) {
		$email_images_path =  public_path().'/images/emails/welcome-new-users/';
		try {
				// $mandrill = new Mandrill(env('MANDRILL_SECRET'));
				$template_name = 'welcome-new-users';
				$template_content = array( // required for some reason
						array(
								'name' => 'example name',
								'content' => 'example content'
						)
				);
				$message = array(
						// 'html' => '<p>Example HTML content</p>',
						// 'text' => 'Example text content',
						// 'subject' => 'example subject',
						// 'from_email' => 'message.from_email@example.com',
						// 'from_name' => 'Example Name',
						'to' => array(
								array(
										'email' => $data['email'],
										'name' => $data['first_name'] . ' ' . $data['last_name'],
										'type' => 'to'
								)
						),
						'headers' => array('Reply-To' => 'info@demhub.net'),
						'important' => false,
						'track_opens' => null,
						'track_clicks' => null,
						'auto_text' => null,
						'auto_html' => null,
						'inline_css' => null,
						'url_strip_qs' => null,
						'preserve_recipients' => null,
						'view_content_link' => null,
						// 'bcc_address' => 'message.bcc_address@example.com',
						'tracking_domain' => null,
						'signing_domain' => null,
						'return_path_domain' => null,
						'merge' => true,
						'merge_language' => 'mailchimp',
						// 'global_merge_vars' => array(
						//     array(
						//         'name' => 'merge1',
						//         'content' => 'merge1 content'
						//     )
						// ),
						'merge_vars' => array(
								array(
										'rcpt' => $data['email'],
										'vars' => array(
												array(
														'name' => 'autoregister_link',
														'content' => url(
															'auth/autoregister?first_name=' . $data['first_name'] .
															'&last_name=' . $data['last_name'] .
															'&email=' . $data['email'] .
															'&job_title=' . $data['job_title'] .
															'&organization_name=' . $data['organization_name'] .
															'&location=' . $data['location']
														)
												)
										)
								)
						),
						// 'tags' => array('password-resets'),
						// 'subaccount' => 'customer-123',
						// 'google_analytics_domains' => array('demhub.net'),
						// 'google_analytics_campaign' => 'message.from_email@example.com',
						// 'metadata' => array('website' => 'www.example.com'),
						// 'recipient_metadata' => array(
						//     array(
						//         'rcpt' => 'recipient.email@example.com',
						//         'values' => array('user_id' => 123456)
						//     )
						// ),
						// 'attachments' => array(
						//     array(
						//         'type' => 'text/plain',
						//         'name' => 'myfile.txt',
						//         'content' => 'ZXhhbXBsZSBmaWxl'
						//     )
						// ),
						'images' => array(
								array(
										'type' => 'image/png',
										'name' => 'banner',
										'content' => File::get($email_images_path.'banner.txt')
								),
								array(
										'type' => 'image/png',
										'name' => 'secondary',
										'content' => File::get($email_images_path.'secondary.txt')
								),
								array(
										'type' => 'image/png',
										'name' => 'twitter',
										'content' => File::get($email_images_path.'twitter.txt')
								)
						)
				);
				$async = false;
				// $ip_pool = 'Main Pool';
				// $send_at = 'example send_at';
				// $result = $mandrill->messages()->sendTemplate($template_name, $template_content, $message, $async);
				$result = \MandrillMail::messages()->sendTemplate($template_name, $template_content, $message, $async);
				// print_r($result);
		} catch(Mandrill_Error $e) {
				// Mandrill errors are thrown as exceptions
				dd ('A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage());
				// i.e. A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
				throw $e;
		}
	}

	/**
	 * @param null
	 * @return \Illuminate\View\View
	 */
	public static function sendAutoregisterEmail($data)
	{
		$email_path =  public_path().'/images/emails/las-vegas-dem-conference/';
		try {
				// $mandrill = new Mandrill(env('MANDRILL_SECRET'));
				$template_name = 'las-vegas-dem-conference';
				$template_content = array( // required for some reason
						array(
								'name' => 'example name',
								'content' => 'example content'
						)
				);
				$message = array(
						// 'html' => '<p>Example HTML content</p>',
						// 'text' => 'Example text content',
						// 'subject' => 'example subject',
						// 'from_email' => 'message.from_email@example.com',
						// 'from_name' => 'Example Name',
						'to' => array(
								array(
										'email' => $data['email'],
										'name' => $data['first_name'] . ' ' . $data['last_name'],
										'type' => 'to'
								)
						),
						'headers' => array('Reply-To' => 'info@demhub.net'),
						'important' => false,
						'track_opens' => null,
						'track_clicks' => null,
						'auto_text' => null,
						'auto_html' => null,
						'inline_css' => null,
						'url_strip_qs' => null,
						'preserve_recipients' => null,
						'view_content_link' => null,
						// 'bcc_address' => 'message.bcc_address@example.com',
						'tracking_domain' => null,
						'signing_domain' => null,
						'return_path_domain' => null,
						'merge' => true,
						'merge_language' => 'mailchimp',
						// 'global_merge_vars' => array(
						//     array(
						//         'name' => 'merge1',
						//         'content' => 'merge1 content'
						//     )
						// ),
						'merge_vars' => array(
								array(
										'rcpt' => $data['email'],
										'vars' => array(
												array(
														'name' => 'autoregister_link',
														'content' => url(
															'auth/autoregister?first_name=' . $data['first_name'] .
															'&last_name=' . $data['last_name'] .
															'&email=' . $data['email'] .
															'&job_title=' . $data['job_title'] .
															'&organization_name=' . $data['organization_name'] .
															'&location=' . $data['location']
														)
												)
										)
								)
						),
						// 'tags' => array('password-resets'),
						// 'subaccount' => 'customer-123',
						// 'google_analytics_domains' => array('demhub.net'),
						// 'google_analytics_campaign' => 'message.from_email@example.com',
						// 'metadata' => array('website' => 'www.example.com'),
						// 'recipient_metadata' => array(
						//     array(
						//         'rcpt' => 'recipient.email@example.com',
						//         'values' => array('user_id' => 123456)
						//     )
						// ),
						// 'attachments' => array(
						//     array(
						//         'type' => 'text/plain',
						//         'name' => 'myfile.txt',
						//         'content' => 'ZXhhbXBsZSBmaWxl'
						//     )
						// ),
						'images' => array(
								array(
										'type' => 'image/png',
										'name' => 'banner',
										'content' => File::get($email_path.'banner.txt')
								),
								array(
										'type' => 'image/png',
										'name' => 'secondary',
										'content' => File::get($email_path.'secondary.txt')
								),
								array(
										'type' => 'image/png',
										'name' => 'twitter',
										'content' => File::get($email_path.'twitter.txt')
								)
						)
				);
				$async = false;
				// $ip_pool = 'Main Pool';
				// $send_at = 'example send_at';
				// $result = $mandrill->messages()->sendTemplate($template_name, $template_content, $message, $async);
				$result = \MandrillMail::messages()->sendTemplate($template_name, $template_content, $message, $async);
				// print_r($result);
		} catch(Mandrill_Error $e) {
				// Mandrill errors are thrown as exceptions
				dd ('A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage());
				// i.e. A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
				throw $e;
		}

	}

	public static function sendInviteEmail($data)
	{
		// TODO - Implement proper email path
		$email_path =  public_path().'/images/emails/las-vegas-dem-conference/';
		try {
				$template_name = 'invite-others';
				$template_content = array( // required for some reason
						array(
								'name' => 'example name',
								'content' => 'example content'
						)
				);
				$message = array(
						'to' => array(
								array(
										'email' => $data['email'],
										'name' => $data['first_name'] . ' ' . $data['last_name'],
										'type' => 'to'
								)
						),
						'headers' => array('Reply-To' => 'info@demhub.net'),
						'important' => false,
						'track_opens' => null,
						'track_clicks' => null,
						'auto_text' => null,
						'auto_html' => null,
						'inline_css' => null,
						'url_strip_qs' => null,
						'preserve_recipients' => null,
						'view_content_link' => null,
						'tracking_domain' => null,
						'signing_domain' => null,
						'return_path_domain' => null,
						'merge' => true,
						'merge_language' => 'mailchimp',
						'merge_vars' => array(
								array(
										'rcpt' => $data['email'],
										'vars' => array(
												array(
														'name' => 'autoregister_link',
														'content' => url(
															'auth/autoregister?email=' . $data['email']
														)
												)
										)
								)
						),
						'images' => array(
								array(
										'type' => 'image/png',
										'name' => 'banner',
										'content' => File::get($email_path.'banner.txt')
								),
								array(
										'type' => 'image/png',
										'name' => 'secondary',
										'content' => File::get($email_path.'secondary.txt')
								),
								array(
										'type' => 'image/png',
										'name' => 'twitter',
										'content' => File::get($email_path.'twitter.txt')
								)
						)
				);
				$async = false;
				$result = \MandrillMail::messages()->sendTemplate($template_name, $template_content, $message, $async);
		} catch(Mandrill_Error $e) {
				// Mandrill errors are thrown as exceptions
				dd ('A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage());
				// i.e. A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
				throw $e;
		}
	}
}
