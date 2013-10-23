from django.conf.urls import patterns, url

from .views import EmailCheckerEndpoint


urlpatterns = patterns('',
    url(r'^check/', EmailCheckerEndpoint.as_view(), name='check_email'),
)
