from django.conf.urls import patterns, include, url

urlpatterns = patterns('',
    url(r'^api/v1/', include('checker.urls')),
)
