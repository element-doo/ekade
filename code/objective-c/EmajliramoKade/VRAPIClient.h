//
//  VRAPIClient.h
//  EmajliramoKade
//
//  Created by Valentin Rep on 10/24/2013.
//  Copyright (c) 2013 Valentin Rep. All rights reserved.
//

#import <Foundation/Foundation.h>

extern NSString * const APIClientServiceGetImageID;
extern NSString * const APIClientServiceSendEmail;
extern NSString * const APIClientStaticGetImage;


@interface VRAPIClient : AFHTTPClient

+ (VRAPIClient *)sharedClient;

@end
