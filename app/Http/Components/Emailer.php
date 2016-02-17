<?php

namespace App\Http\Components;

use App\Models\Access\User\User;
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
			$template_name = 'welcome-new-users';
			$template_content = array( // required for some reason
					array(
							'name' => 'example name',
							'content' => 'example content'
					)
			);
			$message = array(
				'to' => array(
						array(
								'email' => $user->email,
								'name' => $user->full_name(),
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
						'rcpt' => $user->email,
						'vars' => array(
							array(
								'name' => 'user_first_name',
								'content' => $user->first_name
							),
                            array(
								'name' => 'user_email',
								'content' => $user->email
							)
						)
					)
				),
				'images' => array(
					array(
						'type' => 'image/png',
						'name' => 'discuss',
						'content' => File::get($email_images_path.'discuss.txt')
					),
					array(
						'type' => 'image/png',
						'name' => 'earth',
						'content' => File::get($email_images_path.'earth.txt')
					),
					array(
						'type' => 'image/png',
						'name' => 'linked25',
						'content' => File::get($email_images_path.'linked25.txt')
					),
                    array(
						'type' => 'image/png',
						'name' => 'linkedin20',
						'content' => File::get($email_images_path.'linkedin20.txt')
					),
					array(
						'type' => 'image/png',
						'name' => 'logowhite',
						'content' => File::get($email_images_path.'logowhite.txt')
					),
					array(
						'type' => 'image/png',
						'name' => 'people',
						'content' => File::get($email_images_path.'people.txt')
					),
                    array(
						'type' => 'image/png',
						'name' => 'share',
						'content' => File::get($email_images_path.'share.txt')
					),
					array(
						'type' => 'image/png',
						'name' => 'thankyou',
						'content' => File::get($email_images_path.'thankyou.txt')
					),
					array(
						'type' => 'image/png',
						'name' => 'twitter20',
						'content' => File::get($email_images_path.'twitter20.txt')
					),
                    array(
						'type' => 'image/png',
						'name' => 'twitter25',
						'content' => File::get($email_images_path.'twitter25.txt')
					),
					array(
						'type' => 'image/png',
						'name' => 'web',
						'content' => File::get($email_images_path.'web.txt')
					),
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

	public static function sendAutoregisterBetaInvite($data) {
		$email_images_path =  public_path().'/images/emails/beta-testers/';
		try {
			$template_name = 'beta-testers';
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
								'name' => 'user_first_name',
								'content' => $data['first_name'],
							),
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
				'images' => array(
					array(
						'type' => 'image/gif',
						'name' => 'animate',
						'content' => File::get($email_images_path.'animate.txt')
					),
					array(
						'type' => 'image/png',
						'name' => 'bgsmall',
						'content' => File::get($email_images_path.'bgsmall.txt')
					),
					array(
						'type' => 'image/png',
						'name' => 'discuss',
						'content' => File::get($email_images_path.'discuss.txt')
					),
					array(
						'type' => 'image/png',
						'name' => 'linked25',
						'content' => File::get($email_images_path.'linked25.txt')
					),
                    array(
						'type' => 'image/png',
						'name' => 'linkedin20',
						'content' => File::get($email_images_path.'linkedin20.txt')
					),
					array(
						'type' => 'image/png',
						'name' => 'monitor',
						'content' => File::get($email_images_path.'monitor.txt')
					),
					array(
						'type' => 'image/png',
						'name' => 'people',
						'content' => File::get($email_images_path.'people.txt')
					),
                    array(
						'type' => 'image/png',
						'name' => 'share',
						'content' => File::get($email_images_path.'share.txt')
					),
					array(
						'type' => 'image/png',
						'name' => 'thankyou',
						'content' => File::get($email_images_path.'thankyou.txt')
					),
					array(
						'type' => 'image/png',
						'name' => 'twitter20',
						'content' => File::get($email_images_path.'twitter20.txt')
					),
                    array(
						'type' => 'image/png',
						'name' => 'twitter25',
						'content' => File::get($email_images_path.'twitter25.txt')
					),
					array(
						'type' => 'image/png',
						'name' => 'web',
						'content' => File::get($email_images_path.'web.txt')
					),
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

	/**
	 * @param null
	 * @return \Illuminate\View\View
	 */
	public static function sendAutoregisterEmail($data)
	{
		$email_path =  public_path().'/images/emails/las-vegas-dem-conference/';
		try {
			$template_name = 'las-vegas-dem-conference';
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
