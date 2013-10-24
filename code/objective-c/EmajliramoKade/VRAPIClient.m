//
//  VRAPIClient.m
//  EmajliramoKade
//
//  Created by Valentin Rep on 10/24/2013.
//  Copyright (c) 2013 Valentin Rep. All rights reserved.
//

#import "VRAPIClient.h"

static NSString *	const kAPIBaseURLString	= @"http://emajliramokade.com:10070/";
static BOOL			const kAPIDebug			= YES;


// GET		=> nil
//			<= {"kadaID":"546db918-c9e5-412e-ad1f-331d476e7bb0"}
NSString * const APIClientServiceGetImageID		= @"random";

// POST		=> {"email":"pero@pero.com", "kadaID":"546db918-c9e5-412e-ad1f-331d476e7bb0"}
//			<= {"status":false, "poruka":"Domena pero.com ne postoji!"}
NSString * const APIClientServiceSendEmail		= @"zahtjev-check";

// GET		=> set ImageId
//			<= image file
NSString * const APIClientStaticGetImage		= @"https://static.emajliramokade.com/kade/%@.jpg";


@implementation VRAPIClient

+ (VRAPIClient *)sharedClient
{
    static VRAPIClient *_sharedClient = nil;
    static dispatch_once_t onceToken;
	
    dispatch_once(&onceToken, ^
	{
	  _sharedClient = [[[self class] alloc] initWithBaseURL:[NSURL URLWithString:kAPIBaseURLString]];
	});
    
    return _sharedClient;
}


# pragma mark - Custom HTTP Header

- (id)initWithBaseURL:(NSURL *)url
{
    if ( self = [super initWithBaseURL:url] )
	{
        [self registerHTTPOperationClass:[AFJSONRequestOperation class]];
		
		[self setDefaultHeader:@"Accept" value:@"application/json"];
		[self setParameterEncoding:AFJSONParameterEncoding];
    }
    
    return self;
}


# pragma mark - Override super methods - add debug mode

- (void)postPath:(NSString *)path
	  parameters:(NSDictionary *)parameters
		 success:(void (^)(AFHTTPRequestOperation *, id))success
		 failure:(void (^)(AFHTTPRequestOperation *, NSError *))failure
{
	[super postPath:path
		 parameters:parameters
			success:^(AFHTTPRequestOperation *operation, id responseObject)
			{
				[self logDebugger:operation isSuccess:YES];
				
				success(operation, responseObject);
			}
			failure:^(AFHTTPRequestOperation *operation, NSError *error)
			{
				[self logDebugger:operation isSuccess:NO];
				
				[SVProgressHUD showErrorWithStatus:@"Connection error"];
			}
	 ];
}

- (void)getPath:(NSString *)path
	 parameters:(NSDictionary *)parameters
		success:(void (^)(AFHTTPRequestOperation *, id))success
		failure:(void (^)(AFHTTPRequestOperation *, NSError *))failure
{
	[super getPath:path
		parameters:parameters
		   success:^(AFHTTPRequestOperation *operation, id responseObject)
			{
				[self logDebugger:operation isSuccess:YES];
			   
				success(operation, responseObject);
			}
		   failure:^(AFHTTPRequestOperation *operation, NSError *error)
			{
				[self logDebugger:operation isSuccess:NO];
			   
				[SVProgressHUD showErrorWithStatus:@"Connection error"];
			}
	 ];
}


# pragma mark - Debug

- (void)logDebugger:(AFHTTPRequestOperation *)operation isSuccess:(BOOL)isSuccess
{
	if ( kAPIDebug )
	{
		NSString *strType = ( isSuccess ) ? @"SUCCESS" : @"FAILURE";
		
		NSLog(@"\n=== [BGN] %@ === \n\n>>> REQUEST >>> \nURL: %@ \nMETHOD: %@ \nHEADER: \n%@ \nBODY: \n%@ \n\n<<< RESPONSE <<< \nCODE: \n%d \nHEADER: \n%@ \nBODY: \n%@ \n\n=== [END] %@ ===",
			  strType,
			  operation.request.URL,
			  operation.request.HTTPMethod,
			  operation.request.allHTTPHeaderFields,
			  [[NSString alloc] initWithData:operation.request.HTTPBody encoding:4],
			  operation.response.statusCode,
			  operation.response.allHeaderFields,
			  operation.responseString,
			  strType
			  );
	}
}

@end
