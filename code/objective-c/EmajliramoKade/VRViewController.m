//
//  VRViewController.m
//  EmajliramoKade
//
//  Created by Valentin Rep on 10/24/2013.
//  Copyright (c) 2013 Valentin Rep. All rights reserved.
//

#import "VRViewController.h"
#import "VRAPIClient.h"


@interface VRViewController ()

@property (nonatomic, weak) IBOutlet UIImageView *imgView;
@property (nonatomic, weak) IBOutlet UITextField *txtEmail;

@property (nonatomic, strong) NSString *kadaId;

@end


@implementation VRViewController

- (void)viewDidLoad
{
    [super viewDidLoad];
	// Do any additional setup after loading the view, typically from a nib.
	
	
	[self btnActionRefresh:nil];
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}


# pragma mark - Custom Button Actions

- (IBAction)btnActionRefresh:(id)sender
{
	[SVProgressHUD show];
	
	[[VRAPIClient sharedClient] getPath:APIClientServiceGetImageID
							 parameters:nil
								success:^(AFHTTPRequestOperation *operation, id responseObject)
								{
									_kadaId = responseObject[@"kadaID"];
									NSString *strImageUrl = [NSString stringWithFormat:APIClientStaticGetImage, _kadaId];
									NSURL *urlImageUrl = [NSURL URLWithString:strImageUrl];
									[_imgView setImageWithURLRequest:[NSURLRequest requestWithURL:urlImageUrl]
													placeholderImage:nil
															 success:^(NSURLRequest *request, NSHTTPURLResponse *response, UIImage *image)
																{
																	_imgView.image = image;
																	[SVProgressHUD dismiss];
																}
															 failure:^(NSURLRequest *request, NSHTTPURLResponse *response, NSError *error)
																 {
																	 [SVProgressHUD showErrorWithStatus:@"Error downloading image"];
																 }
									 ];
									
									
								}
								failure:nil
	 ];
}

- (IBAction)btnActionSend:(id)sender
{
	[SVProgressHUD show];
	
	NSString *strEmail = [_txtEmail.text stringByTrimmingCharactersInSet:[NSCharacterSet whitespaceCharacterSet]];
	NSDictionary *dicParams = @{ @"email": strEmail, @"kadaID": _kadaId };
	
	if ( strEmail )
	{
		[[VRAPIClient sharedClient] postPath:APIClientServiceSendEmail
								  parameters:dicParams
									 success:^(AFHTTPRequestOperation *operation, id responseObject)
										{
											BOOL success = [responseObject[@"status"] boolValue];
											NSString *message = responseObject[@"poruka"];

											( success ) ? [SVProgressHUD showSuccessWithStatus:message] : [SVProgressHUD showErrorWithStatus:message];
										}
									 failure:nil
		 ];
	}
}


# pragma mark - UITextField Delegate

- (BOOL)textFieldShouldReturn:(UITextField *)textField
{
    [textField resignFirstResponder];
    
	[self btnActionSend:nil];
	
    return YES;
}

@end
