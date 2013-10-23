from django.test import TestCase
from mock import patch, Mock, MagicMock
import json

from .forms import EmailForm


class EmailFormTest(TestCase):

    def test_invalid_email_format_rejected(self):
        form = EmailForm({
            'email': 'whatever'
        })
        form.clean_email = MagicMock()

        self.assertFalse(form.is_valid())
        self.assertTrue('email' in form.errors)
        self.assertFalse(form.clean_email.called)

    @patch('checker.forms.query')
    def test_valid_format_email_suceeds_if_mx_check_succeeds(self, query):
        form = EmailForm({
            'email': 'foo@bar.com',
        })

        query.return_value = Mock(rrset=Mock(items=['10 mail.bar.com']))

        self.assertTrue(form.is_valid())
        query.assert_called_once_with('bar.com', 'MX')

    @patch('checker.forms.query')
    def test_check_fails_if_mx_fails_for_valid_format_mail(self, query):
        form = EmailForm({
            'email': 'foo@bar.com',
        })

        query.side_effect = Exception

        self.assertFalse(form.is_valid())
        query.assert_called_once_with('bar.com', 'MX')


class CheckerApiTest(TestCase):

    @patch('checker.forms.query')
    def test_api_call_succeeds_with_good_email_address(self, query):
        query.return_value = Mock(rrset=Mock(items=['10 mail.bar.com']))

        resp = self.client.post('/api/v1/check/', data=json.dumps({
            'email': 'foo@bar.com'
        }), content_type='application/json')

        self.assertEqual(resp.status_code, 200)
        query.assert_called_once_with('bar.com', 'MX')

    @patch('checker.forms.query')
    def test_api_call_fails_with_bad_email_address(self, query):
        query.side_effect = Exception

        resp = self.client.post('/api/v1/check/', data=json.dumps({
            'email': 'foo@bar.com'
        }), content_type='application/json')

        self.assertEqual(resp.status_code, 400)
        query.assert_called_once_with('bar.com', 'MX')
