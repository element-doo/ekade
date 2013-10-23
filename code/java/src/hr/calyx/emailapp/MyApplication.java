package hr.calyx.emailapp;

import android.app.Application;

import com.nostra13.universalimageloader.core.ImageLoader;
import com.nostra13.universalimageloader.core.ImageLoaderConfiguration;

public class MyApplication extends Application {
    @Override
    public void onCreate() {
        super.onCreate();

        ImageLoaderConfiguration config = new ImageLoaderConfiguration.Builder(getApplicationContext()).build();
        ImageLoader.getInstance().init(config);
    }
}
