package hr.calyx.emailapp.ui;

import hr.calyx.emailapp.R;

import java.io.InputStream;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.entity.StringEntity;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicHeader;
import org.apache.http.params.BasicHttpParams;
import org.apache.http.params.HttpConnectionParams;
import org.apache.http.protocol.HTTP;
import org.apache.http.util.EntityUtils;
import org.json.JSONObject;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.graphics.Bitmap;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;

import com.nostra13.universalimageloader.core.ImageLoader;
import com.nostra13.universalimageloader.core.assist.FailReason;
import com.nostra13.universalimageloader.core.assist.SimpleImageLoadingListener;

public class MainActivity extends Activity implements OnClickListener {

	private static final String GET_URI = "http://emajliramokade.com:10070/random";
	private static final String API_URI = "http://emajliramokade.com:10070/zahtjev-check";
	private static final String IMAGE_URI = "https://static.emajliramokade.com/kade/";
	private static final String BUCKET_ID_KEY = "kadaID";
	private static final String IMAGE_EXTENSTION = ".jpg";

	private static final String DIALOG_BUTTON_TEXT = "OK";

	private static final String CONNECTION_DIALOG_TITLE = "Connection error!";
	private static final String CONNECTION_DIALOG_MESSAGE = "Unable to retrieve image.";

	private static final String EMAIL_DIALOG_TITLE = "Invalid e-mail!";
	private static final String EMAIL_DIALOG_MESSAGE = "Please enter valid e-mail address.";

	private static final String SUCCESS_DIALOG_TITLE = "Success!";
	private static final String SUCCESS_DIALOG_MESSAGE = "E-mail sent.";

	private static final String EMAIL_KEY = "email";

	private Button sendButton;

	private EditText emailBox;

	private ImageView background;

	private View loader;
	private View inputForm;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_main);

		setBackgroundImage();

		initUI();
	}

	private void setBackgroundImage() {

		IdOperation operation = new IdOperation();
		String bucketId = null;
		try {
			bucketId = operation.execute().get();
		} catch (Exception e) {
			showConnectionError();
		} 

		String fullImageUri = IMAGE_URI + bucketId + IMAGE_EXTENSTION;

		ImageLoader.getInstance().loadImage(fullImageUri, new MyImageLoader());
	}

	private void initUI() {

		background = (ImageView) findViewById(R.id.background);
		loader = findViewById(R.id.loadingPanel);
		inputForm = findViewById(R.id.inputform);
		sendButton = (Button) findViewById(R.id.sendButton);
		sendButton.setOnClickListener(this);
		emailBox = (EditText) findViewById(R.id.emailText);

	}

	public void onClick(View v) {
		Thread t = new Thread(new Runnable() {

			@Override
			public void run() {
				HttpClient client = new DefaultHttpClient();
				HttpConnectionParams.setConnectionTimeout(client.getParams(),
						10000);
				JSONObject json = new JSONObject();

				String emailText = emailBox.getText().toString();

				if (!isValidEmail(emailText)) {
					return;
				}
				
				try {
					HttpPost post = new HttpPost(API_URI);
					json.put(EMAIL_KEY, emailText);
					StringEntity se = new StringEntity(json.toString());
					se.setContentType(new BasicHeader(HTTP.CONTENT_TYPE,
							"application/json"));
					post.setEntity(se);

					new AlertDialog.Builder(MainActivity.this)
							.setTitle(SUCCESS_DIALOG_TITLE)
							.setMessage(SUCCESS_DIALOG_MESSAGE)
							.setPositiveButton(DIALOG_BUTTON_TEXT,
									new DialogInterface.OnClickListener() {
										@Override
										public void onClick(
												DialogInterface dialog,
												int which) {
										}
									}).show();
					emailBox.setText("");

				} catch (Exception e) {
					showConnectionError();
				}
			}
		});
		t.run();
	}

	private class IdOperation extends AsyncTask<Void, Void, String> {

		@Override
		protected String doInBackground(Void... params) {
			DefaultHttpClient httpclient = new DefaultHttpClient(
					new BasicHttpParams());

			HttpGet httpget = null;
			HttpResponse response = null;

			InputStream inputStream = null;
			String result = null;
			JSONObject json = null;
			String bucketId = null;

			try {
				httpget = new HttpGet(GET_URI);
				httpget.setHeader("Content-type", "application/json");
				response = httpclient.execute(httpget);
				HttpEntity entity = response.getEntity();

				result = EntityUtils.toString(entity);

				json = new JSONObject(result);
				bucketId = json.getString(BUCKET_ID_KEY);
			} catch (Exception e) {
				showConnectionError();
			} finally {
				try {
					if (inputStream != null)
						inputStream.close();
				} catch (Exception ignorable) {
				}
			}
			return bucketId;
		}
		
	}
	
	private class MyImageLoader extends SimpleImageLoadingListener {
		@Override
		public void onLoadingComplete(String imageUri, View view,
				Bitmap loadedImage) {
			loader.setVisibility(View.GONE);
			inputForm.setVisibility(View.VISIBLE);
			background.setVisibility(View.VISIBLE);

			background.setImageBitmap(loadedImage);
		}

		@Override
		public void onLoadingFailed(String imageUri, View view,
				FailReason reason) {
			showConnectionError();
		}

	}

	private boolean isValidEmail(String emailText) {
		if (emailText.equals("") || !emailText.matches("\\w+@\\w+\\.\\w+")) {
			new AlertDialog.Builder(MainActivity.this)
					.setTitle(EMAIL_DIALOG_TITLE)
					.setMessage(EMAIL_DIALOG_MESSAGE)
					.setPositiveButton(DIALOG_BUTTON_TEXT,
							new DialogInterface.OnClickListener() {
								@Override
								public void onClick(DialogInterface dialog,
										int which) {
								}
							}).show();
			return false;
		} else {
			return true;
		}
	}

	private void showConnectionError() {
		new AlertDialog.Builder(MainActivity.this)
				.setTitle(CONNECTION_DIALOG_TITLE)
				.setMessage(CONNECTION_DIALOG_MESSAGE)
				.setPositiveButton(DIALOG_BUTTON_TEXT,
						new DialogInterface.OnClickListener() {
							@Override
							public void onClick(DialogInterface dialog,
									int which) {
								finish();
							}
						}).show();
	}
}
