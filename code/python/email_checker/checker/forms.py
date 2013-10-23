from django import forms
from dns.resolver import query
from django.core.cache import cache

class EmailForm(forms.Form):
    email = forms.EmailField(required=True)

    def clean_email(self):
        addr = self.cleaned_data['email']
        user, domain = addr.split('@')

        has_mx = cache.get(domain)

        if has_mx is None:
            try:
                response = query(domain, 'MX')
                has_mx = (len(response.rrset.items) > 0)
            except:
                has_mx = False
            finally:
                cache.set(domain, has_mx)

        if has_mx:
            return addr

        raise forms.ValidationError('Please enter an existing email address.')
