<xsl:stylesheet version="1.0" encoding="UTF-8" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output indent="yes"/>
  <xsl:strip-space elements="*"/>

  <!-- IDENTITY TRANSFORM TO COPY DOCUMENT AS IS -->
  <xsl:template match="@*|node()">
    <xsl:copy>
      <xsl:apply-templates select="@*|node()"/>
    </xsl:copy>
  </xsl:template>

  <xsl:template match="class">
    <xsl:copy>
      <xsl:apply-templates select="name|hd|proficiency|spellAbility|numSkills"/>
      <xsl:for-each select="autolevel01">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="autolevel01-{$pos}-name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="autolevel01-{$pos}-text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;&#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="autolevel02">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="autolevel02-{$pos}-name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="autolevel02-{$pos}-text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;&#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="autolevel03">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="autolevel03-{$pos}-name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="autolevel03-{$pos}-text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;&#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>


      <xsl:for-each select="autolevel04">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="autolevel04-{$pos}-name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="autolevel04-{$pos}-text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;&#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="autolevel05">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="autolevel05-{$pos}-name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="autolevel05-{$pos}-text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;&#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="autolevel06">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="autolevel06-{$pos}-name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="autolevel06-{$pos}-text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;&#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="autolevel07">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="autolevel07-{$pos}-name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="autolevel07-{$pos}-text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;&#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="autolevel08">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="autolevel08-{$pos}-name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="autolevel08-{$pos}-text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;&#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="autolevel09">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="autolevel09-{$pos}-name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="autolevel09-{$pos}-text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;&#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="autolevel10">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="autolevel10-{$pos}-name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="autolevel10-{$pos}-text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;&#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="autolevel11">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="autolevel11-{$pos}-name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="autolevel11-{$pos}-text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;&#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="autolevel12">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="autolevel12-{$pos}-name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="autolevel12-{$pos}-text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;&#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="autolevel13">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="autolevel13-{$pos}-name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="autolevel13-{$pos}-text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;&#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="autolevel14">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="autolevel14-{$pos}-name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="autolevel14-{$pos}-text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;&#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="autolevel15">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="autolevel15-{$pos}-name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="autolevel15-{$pos}-text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;&#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="autolevel16">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="autolevel16-{$pos}-name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="autolevel16-{$pos}-text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;&#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="autolevel17">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="autolevel17-{$pos}-name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="autolevel17-{$pos}-text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;&#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="autolevel18">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="autolevel18-{$pos}-name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="autolevel18-{$pos}-text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;&#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="autolevel19">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="autolevel19-{$pos}-name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="autolevel19-{$pos}-text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;&#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="autolevel20">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="autolevel20-{$pos}-name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="autolevel20-{$pos}-text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;&#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>


    </xsl:copy>
  </xsl:template>

</xsl:stylesheet>
